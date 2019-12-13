<?php
/**
 * Created by PhpStorm.
 * User: darryldecode
 * Date: 4/2/2018
 * Time: 8:40 AM
 */

namespace App\Http\Controllers\Src;


use App\Components\Core\Menu\MenuItem;
use App\Components\Core\Menu\MenuManager;
use App\Components\Security\Models\User;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function display()
    {
        /**
         * @var User $currentUser
         */
        $currentUser = \Auth::user();
        $menuManager = new MenuManager();
        $menuManager->setUser($currentUser);
        $menuManager->addMenus([
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label'=>'Dashboard',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'dashboard',
                'route_type'=>'vue',
                'route_name'=>'dashboard',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Interaksi',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'assignment',
                'route_type'=>'vue',
                'route_name'=>'interaksi.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label'=>'User',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'person',
                'route_type'=>'vue',
                'route_name'=>'users.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['superuser'],
                'label'=>'Files',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'cloud_circle',
                'route_type'=>'vue',
                'route_name'=>'files',
                'visible'=>true,
            ]),

            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Master',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'master',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Dropdown Variant',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'dropdown',
                'visible'=>true,
            ]),

            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Advertise',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'advertise.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'ConfirmStatus',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'confirmstatus.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Gender',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'gender.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'MemberCard',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'membercard.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Pasien',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'pasien.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'PasienMember',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'pasienmember.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'PasienStatus',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'folder_shared',
                'route_type'=>'vue',
                'route_name'=>'pasienstatus.list',
                'visible'=>true,
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => ['marketing.klinik','marketing.produk'],
                'label'=>'Settings',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'icon'=>'settings',
                'route_type'=>'vue',
                'route_name'=>'settings',
                'visible'=>true,
            ]),
            new MenuItem([
                'nav_type' => MenuItem::$NAV_TYPE_DIVIDER
            ])
        ]);

        $menus = $menuManager->getFiltered();

        view()->share('nav',$menus);

        return view('layouts.panel');
    }
}