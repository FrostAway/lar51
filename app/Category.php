<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'category';
    protected $fillable = ['name', 'slug', 'type', 'order', 'parent', 'count'];
    protected $cattree = [];
    
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
    
    public function menus(){
        return $this->belongsToMany('App\Menu');
    }
  
    protected function list_tree_tr($lists, $parent, $depth = 0, $option = null) {
        $output = '';
        foreach ($lists as $key => $item) {
            if ($item->parent == $parent) {
                $output.= '<tr class="depth-' . $depth . '">' .
                        '<td><input type="checkbox" name="massdel[' . $item->id . ']" class="checkitem" /></td>' .
                       
                        '<td>' . $item->name . '</td>' .
                        '<td>' . $item->slug . '</td>' .
                        '<td>' . $item->parent . '</td>' .
                        '<td>' . $item->order . '</td>' .
                        '<td>' . $item->count . '</td>' .
                        '<td>' . $item->id . '</td>' .
                        '<td>
                                <a href="' . route('admin.cat.edit', $item->id) . '" class="btn btn-info btn-sm item-edit" title="Chỉnh sửa"><span class="fa fa-pencil"></span></a>  
                                <a href="' . route('admin.cat.delete', [$item->id, $option]) . '" class="btn btn-danger btn-sm item-delete" title="Xóa"><span class="fa fa-close"></span></a>
                            </td>' .
                        '</tr>';
                unset($lists[$key]);

                $output2 = $this->list_tree_tr($lists, $item->id, $depth + 1);
                if ($output2 != '') {
                    $output .= $output2;
                }
            }
        }
        return $output;
    }
    
    protected function list_tree_label($lists, $parent, $depth, $option=null){
        $output = '';
        foreach ($lists as $key => $item) {
            if ($item->parent == $parent) {
                if($option != null){
                    $output.= '<div class="depth-' . $depth . '">' .
                            '<label><input type="checkbox" name="cats[]" value="' . $item->id . '" '.  checkecho($item->id, $option, false).' /> '. $item->name .'</label>' .
                            '</div>';
                }else{
                    $output.= '<div class="depth-' . $depth . '">' .
                        '<label><input type="checkbox" name="cats[]" value="' . $item->id . '" /> '. $item->name .'</label>' .
                        '</div>';
                }
                unset($lists[$key]);
                $output2 = $this->list_tree_label($lists, $item->id, $depth + 1, $option);
                if ($output2 != '') {
                    $output .= $output2;
                }
            }
        }
        return $output;
    }

}
