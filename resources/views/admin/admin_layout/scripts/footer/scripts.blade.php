{{--
Blade files for admin footer scripts.
These files are used to include scripts, vendor files and map files for the admin panel.
It is recommended not to modify these files since they may be overwritten on Admiko updates.
Note: To avoid overwriting, it is recommended to add your custom code to the 'custom.top', 'custom.variable', 'custom.variable', 'custom.vendors' and 'custom.bottom' files.
--}}
@includeIf('admin.admin_layout.scripts.footer.custom.top') {{--Custom top footer code can be added here.--}}

@includeIf('admin.admin_layout.scripts.footer.system.config') {{--Used to setup JS variables.--}}
@includeIf('admin.admin_layout.scripts.footer.custom.config') {{--Custom footer variables code can be added here.--}}

@includeIf('admin.admin_layout.scripts.footer.system.vendors') {{--Used for loading vendors JS.--}}
@includeIf('admin.admin_layout.scripts.footer.custom.vendors') {{--Custom footer vendors code can be added here.--}}

@includeIf('admin.admin_layout.scripts.footer.system.scripts') {{--Load base JS classes JS.--}}
@includeIf('admin.admin_layout.scripts.footer.system.start_scripts') {{--Start JS.--}}
@includeIf('admin.admin_layout.scripts.footer.system.scripts_deprecated') {{--Used to keep backward compatibility.--}}
@includeIf('admin.admin_layout.scripts.footer.system.maps') {{--Used for loading maps if map key is configured in confg area.--}}

@includeIf('admin.admin_layout.scripts.footer.custom.bottom') {{--Custom bottom footer code can be added here.--}}

