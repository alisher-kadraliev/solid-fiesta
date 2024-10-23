<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified.
 * Any custom code should be added elsewhere to avoid losing changes during updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 */

namespace App\Http\Controllers\Admin\AdminService\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait AdminDatabaseTrait
{
    public function setupDatabase($tableData, $decode = true)
    {
        foreach ($tableData as $dataCoded) {
            $data = $dataCoded;
            $after_column = 'id';
            if (!Schema::hasTable($data->table)) {
                Schema::create($data->table, function (Blueprint $table) use ($data) {
                    $table->id();
                });
            }
            if (isset($data->table_columns) && count($data->table_columns) > 0) {
                foreach ($data->table_columns as $column_data) {
                    if (!Schema::hasColumn($data->table, $column_data->name)) {
                        Schema::table($data->table, function (Blueprint $table) use ($column_data, $after_column) {
                            if (property_exists($column_data, "type") && isset($column_data->type) &&
                                property_exists($column_data, "name") && isset($column_data->name)) {
                                $column = $table->{$column_data->type}($column_data->name);
                                if (property_exists($column_data, "default") && isset($column_data->default)) {
                                    $column->default($column_data->default);
                                }
                                if (property_exists($column_data, "length") && $column_data->length) {
                                    $column->length($column_data->length);
                                }
                                if (property_exists($column_data, "total") && $column_data->total) {
                                    $column->total($column_data->total);
                                }
                                if (property_exists($column_data, "places") && $column_data->places) {
                                    $column->places($column_data->places);
                                }
                                if (property_exists($column_data, "nullable") && $column_data->nullable == 1) {
                                    $column->nullable();
                                }
                                if (property_exists($column_data, "unique") && $column_data->unique == 1) {
                                    $column->unique();
                                }
                                if (property_exists($column_data, "unsigned") && $column_data->unsigned == 1) {
                                    $column->unsigned();
                                }
                                if (property_exists($column_data, "after") && $column_data->after) {
                                    $column->after($column_data->after);
                                } elseif (property_exists($column_data, "keep_after") && $column_data->keep_after == 1) {
                                    $column->after($after_column);
                                }
                            }
                        });
                    }
                    $after_column = $column_data->name;
                }
            }
        }
    }
}
