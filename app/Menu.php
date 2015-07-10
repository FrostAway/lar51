<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    protected $table = 'menus';
    protected $fiable = ['id', 'name', 'parent', 'type', 'link', 'status', 'order'];

    public function groups() {
        return $this->belongsToMany('App\Category');
    }

    protected function list_tree_tr($lists, $parent, $depth = 0, $option = null) {
        $output = '';
        foreach ($lists as $key => $item) {
            if ($item->parent == $parent) {
                $output.= '<tr class="depth-' . $depth . '">' .
                        '<td><input type="checkbox" name="massdel[' . $item->id . ']" class="checkitem" /></td>' .
                        '<td>' . $item->name . '</td>' .
                        '<td>' . $item->parent . '</td>' .
                        '<td>' . $item->type . '</td>' .
                        '<td>' . $item->link . '</td>' .
                        '<td>' . $item->status . '</td>' .
                        '<td>' . $item->order . '</td>' .
                        '<td>' . $item->icon . '</td>' .
                        '<td>
                                <a href="' . route('menuitem.edit', [$item->id, $option]) . '" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="' . route('menuitem.delete', [$item->id, $option]) . '" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>' .
                        '</tr>';
                unset($lists[$key]);

                $output2 = $this->list_tree_tr($lists, $item->id, $depth + 1, $option);
                if ($output2 != '') {
                    $output .= $output2;
                }
            }
        }
        return $output;
    }

    protected function list_menus($lists, $parent, $depth = 0, $option = null) {
        $output = '';
        foreach ($lists as $key => $item) {
            if ($item->parent == $parent) {
                $output.= '<li>' .
                        '<a menu-id="' . $item->id . '" href="' . url($item->link) . '"><i class="fa '.$item->icon.'"></i>' . $item->name . '</a>';

                unset($lists[$key]);

                $output2 = $this->list_menus($lists, $item->id, $depth + 1, $option);
                if ($output2 != '') {
                    $output .= '<ul class="depth-' . ($depth + 1) . '">' . $output2 . '</ul>';
                }
                $output.= '</li>';
            }
        }
        return $output;
    }

}
