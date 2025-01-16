<?php

namespace Database\Seeders;

use App\Models\AdminMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminMenu::whereRaw('1=1')->delete();

        $data = [
            [
                'id'    => 1,
                'label' => 'Dashboard',
                'icon'  => 'bx bxs-dashboard',
                'route_name' => 'admin.dashboard',
                'admin_menu_id' => null,
                'role'  => 'admin,hr,feed,enquiry'
            ],
            [
                'id'    => 2,
                'label' => 'Slides',
                'icon'  => 'bx bx-images',
                'admin_menu_id' => null,
                'route_name' => 'admin.slider.index',
                'role'  => 'admin'
            ],
            [
                'id'    => 3,
                'label' => 'Category',
                'icon'  => 'bx bx-category',
                'route_name' => 'admin.category.index',
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 4,
                'label' => 'Pages',
                'icon'  => 'bx bx-file',
                'route_name' => 'admin.page.index',
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 5,
                'label' => 'Project',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 6,
                'label' => 'Create New Project',
                'icon'  => null,
                'route_name' => 'admin.project.create',
                'admin_menu_id' => 5,
                'role'  => 'admin'
            ],
            [
                'id'    => 7,
                'label' => 'View Projects',
                'icon'  => null,
                'route_name' => 'admin.project.index',
                'admin_menu_id' => 5,
                'role'  => 'admin'
            ],
            [
                'id'    => 8,
                'label' => 'Phase',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 9,
                'label' => 'Add Phase',
                'icon'  => null,
                'route_name' => 'admin.phase.create',
                'admin_menu_id' => 8,
                'role'  => 'admin'
            ],
            [
                'id'    => 10,
                'label' => 'View Phase',
                'icon'  => null,
                'route_name' => 'admin.phase.index',
                'admin_menu_id' => 8,
                'role'  => 'admin'
            ],
            [
                'id'    => 11,
                'label' => 'Tower',
                'icon'  => 'bx bx-folder',
                'route_name' => 'admin.tower.index',
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            // [
            //     'id'    => 12,
            //     'label' => 'Flats',
            //     'icon'  => 'bx bx-folder',
            //     'route_name' => 'admin.flat.index',
            //     'admin_menu_id' => null,
            // ],
            [
                'id'    => 13,
                'label' => 'Construction Update',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 14,
                'label' => 'Create New Construction Update',
                'icon'  => null,
                'route_name' => 'admin.construction-update.create',
                'admin_menu_id' => 13,
                'role'  => 'admin'
            ],
            [
                'id'    => 15,
                'label' => 'View Construction Updates',
                'icon'  => null,
                'route_name' => 'admin.construction-update.index',
                'admin_menu_id' => 13,
                'role'  => 'admin'
            ],
            [
                'id'    => 16,
                'label' => 'Career Post',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin,hr'
            ],
            [
                'id'    => 17,
                'label' => 'Create New Career Post',
                'icon'  => null,
                'route_name' => 'admin.career-post.create',
                'admin_menu_id' => 16,
                'role'  => 'admin,hr'
            ],
            [
                'id'    => 18,
                'label' => 'View Career Posts',
                'icon'  => null,
                'route_name' => 'admin.career-post.index',
                'admin_menu_id' => 16,
                'role'  => 'admin,hr'
            ],
            [
                'id'    => 19,
                'label' => 'Team',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 20,
                'label' => 'Create New Team',
                'icon'  => null,
                'route_name' => 'admin.team.create',
                'admin_menu_id' => 19,
                'role'  => 'admin'
            ],
            [
                'id'    => 21,
                'label' => 'View Teams',
                'icon'  => null,
                'route_name' => 'admin.team.index',
                'admin_menu_id' => 19,
                'role'  => 'admin'
            ],
            [
                'id'    => 22,
                'label' => 'Media',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 23,
                'label' => 'Category',
                'icon'  => null,
                'route_name' => 'admin.media-category.index',
                'admin_menu_id' => 22,
                'role'  => 'admin'
            ],
            [
                'id'    => 24,
                'label' => 'Create New Media',
                'icon'  => null,
                'route_name' => 'admin.media.create',
                'admin_menu_id' => 22,
                'role'  => 'admin'
            ],
            [
                'id'    => 25,
                'label' => 'View Medias',
                'icon'  => null,
                'route_name' => 'admin.media.index',
                'admin_menu_id' => 22,
                'role'  => 'admin'
            ],
            [
                'id'    => 26,
                'label' => 'FAQ',
                'icon'  => 'bx bx-folder',
                'route_name' => null,
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 27,
                'label' => 'Category',
                'icon'  => null,
                'route_name' => 'admin.faq-category.index',
                'admin_menu_id' => 26,
                'role'  => 'admin'
            ],
            [
                'id'    => 28,
                'label' => 'Create New FAQ',
                'icon'  => null,
                'route_name' => 'admin.faq.create',
                'admin_menu_id' => 26,
                'role'  => 'admin'
            ],
            [
                'id'    => 29,
                'label' => 'View FAQs',
                'icon'  => null,
                'route_name' => 'admin.faq.index',
                'admin_menu_id' => 26,
                'role'  => 'admin'
            ],
            [
                'id'    => 30,
                'label' => 'Video Gallery',
                'icon'  => 'bx bx-video',
                'route_name' => 'admin.video-gallery.index',
                'admin_menu_id' => null,
                'role'  => 'admin'
            ],
            [
                'id'    => 51,
                'label' => 'Career Enquiry',
                'icon'  => 'bx bx-file-find',
                'route_name' => 'admin.career-enquiry.index',
                'admin_menu_id' => null,
                'role'  => 'admin,hr'
            ],
            [
                'id'    => 52,
                'label' => 'Contact Enquiry',
                'icon'  => 'bx bx-phone',
                'route_name' => 'admin.contact-enquiry.index',
                'admin_menu_id' => null,
                'role'  => 'admin,enquiry'
            ],
            [
                'id'    => 53,
                'label' => 'Logout',
                'icon'  => 'bx bx-power-off',
                'route_name' => 'admin.logout',
                'admin_menu_id' => null,
                'role'  => 'admin,hr,feed,enquiry'
            ],
        ];

        AdminMenu::insert($data);
    }
}
