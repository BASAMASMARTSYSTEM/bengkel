<?php

function asset_images(){
   return base_url().'assets/images/';
}

function asset_css(){
   return base_url().'assets/css/';
}

function asset_js(){
   return base_url().'assets/js/';
}

function sbase_url($path = NULL) {
  return base_url() . $path . '.html';
}

function foto_url($path = NULL) {
  return base_url() . 'assets/upload/';
}