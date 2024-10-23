{{--
This file is managed by Admiko and is not recommended to be modified since it may be overwritten during Admiko updates.
Blade template files used to create the admin panel menu.
The 'menu_import.menu' file is the main menu imported by Admiko and should not be modified.
Note: To avoid overwriting, it is recommended to add your custom links to the 'custom.menu_top', and 'custom.menu_bottom' files.
--}}
@includeIf('admin.admin_menu.custom.menu_top')  {{--Custom top menu links can be added here.--}}
@includeIf('admin.admin_menu.menu_import.menu') {{--Main menu imported by Admiko--}}
@includeIf('admin.admin_menu.custom.menu_bottom') {{--Custom bottom menu links can be added here.--}}

