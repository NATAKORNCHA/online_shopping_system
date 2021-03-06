<?php

class Product extends \Eloquent {
  protected $fillable = [];

  public function orders()
  {
    return $this->belongsToMany('Order');
  }

  public function delete()
  {
    OrderProduct::where('product_id', '=', $this->id)->delete();
    return parent::delete();
  }
}
