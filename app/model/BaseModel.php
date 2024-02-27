<?php

namespace app\model;
use think\Model;

class BaseModel extends Model {
    /**
     * mapping forgin key to User table
     */
    public function user() {
        return $this->belongsTo(User::class, "userId","id");
    }
}