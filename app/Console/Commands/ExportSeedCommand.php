<?php


namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class ExportSeedCommand extends Command
{
    protected $signature = 'admin:export-seed {classname=AdminTablesSeeder}';

    protected $description = 'Export seed a admin database tables menu, roles and permissions';

    public function handle()
    {
        $name = $this->argument('classname');
        $exceptFields = [];

        $namespace = version_compare(app()->version(), '8.0.0', '<') ? 'seeds' : 'seeders';
        $seedFile = $this->laravel->databasePath().'/'.$namespace.'/'.$name.'.php';
        $contents = $this->getStub('AdminTablesSeeder');

        $replaces = [
            'DummyNamespace' => ucwords($namespace),
            'DummyClass' => $name,

            'TableMenu'       => 'menus',
            'TableRole'       => 'roles',
            'TableAdmin'        => 'admins',
            'TableRoleMenu'        => 'role_menu',
            'ArrayMenu'       => $this->getTableDataArrayAsString('menus', $exceptFields),
            'ArrayRole'       => $this->getTableDataArrayAsString('roles', $exceptFields),
            'ArrayAdmin'       => $this->getTableDataArrayAsString('admins', $exceptFields),
            'ArrayPivotRoleMenu'        => $this->getTableDataArrayAsString('role_menu', $exceptFields),
        ];

        $contents = preg_replace('/\/\/ users tables[\s\S]*?(?=\/\/ finish)/mu', '', $contents);
        $contents = str_replace(array_keys($replaces), array_values($replaces), $contents);
        $this->laravel['files']->put($seedFile, $contents);

        $this->line('<info>Admin tables seed file was created:</info> '.str_replace(base_path(), '', $seedFile));
        $this->line("Use: <info>php artisan db:seed --class={$name}</info>");
    }

    /**
     * Get stub contents.
     * @param $name
     *
     * @return mixed
     */
    protected function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__."/stubs/$name.stub");
    }

    /**
     * Get data array from table as string result var_export.
     * @param         $table
     * @param  array  $exceptFields
     *
     * @return string|null
     */
    protected function getTableDataArrayAsString($table, $exceptFields = [])
    {
        $fields = DB::getSchemaBuilder()->getColumnListing($table);
        $fields = array_diff($fields, $exceptFields);

        $array = DB::table($table)->get($fields)->map(function ($item) {
            return (array) $item;
        })->all();

        return $this->varExport($array, str_repeat(' ', 12));
    }

    /**
     * Custom var_export for correct work with \r\n.
     * @param          $var
     * @param  string  $indent
     *
     * @return string|null
     */
    protected function varExport($var, $indent = '')
    {
        switch (gettype($var)) {
            case 'string':
                return '"' . addcslashes($var, "\\\$\"\r\n\t\v\f") . '"';

            case 'array':
                $indexed = array_keys($var) === range(0, count($var) - 1);

                $r = [];

                foreach ($var as $key => $value) {
                    $r[] = "$indent    "
                           . ($indexed ? '' : $this->varExport($key) . ' => ')
                           . $this->varExport($value, "{$indent}    ");
                }

                return "[\n" . implode(",\n", $r) . "\n" . $indent . ']';

            case 'boolean':
                return $var ? 'true' : 'false';

            case 'integer':
            case 'double':
                return $var;

            default:
                return var_export($var, true);
        }
    }
}