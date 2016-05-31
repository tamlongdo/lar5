<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
class BaseModel extends Model {
    
    protected $table = "";
    protected $id = "id";
    
    /**
     * 
     * @param string $where
     * @return unknown
     */
    public function getOne($where = "")
    {
        $item = DB::table($this->table)->where($where)->first();
        return $item;
    }
    
    /**
     * 
     * @param unknown $arrData
     * @return boolean
     */
    public function insert($arrData = array())
    {
        $q = DB::table($this->table)->insert($arrData);
        if(!$q){
            return false;
        }
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Illuminate\Database\Eloquent\Model::update()
     */
    public function update($id, $arrData)
    {
        $q = DB::table($this->table)->where($this->id, $id)->update($arrData);
        if(!$q){
            return false;
        }
        return true;
    }
}