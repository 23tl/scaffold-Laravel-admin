<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Admin Password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name     = $this->ask('请输入您要修改的账户?');
        $password = $this->secret('请输入您要修改的密码?');
        if ( ! $admin = Admin::where('name', $name)->first()) {
            $this->error('您要修改的账户不存在!');
        }
        $admin->password = $password;
        $admin->save();
        $this->info('密码修改成功！');
    }
}
