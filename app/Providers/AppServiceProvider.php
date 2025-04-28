<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\SettingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                $roleId = $user->role_id;

                $menuIds = SettingMenu::where('role_id', $roleId)->pluck('menu_id');
                $menus = Menu::whereIn('id', $menuIds)->get();
            } else {
                $menus = collect(); // kosong jika belum login
            }

            $view->with('accessibleMenus', $menus);
        });
    }
}
