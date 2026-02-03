<?php
require_once(SITE_ROOT."book/models/book/book.class.php");
class users extends global_class 
{
var $book;
public $users_lang;
function __construct()
	{
	include(SITE_ROOT."config/global.php");
	include(SITE_ROOT."users/lang/".$glob_config['db_config']['lang']."/lang.php");
	parent::__construct();
	$this->book = new book();
	$this->users_lang = $users_lang;
	}

//village
function delete_village($village_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$village_code=$this->db_fldrow("village","village_code","village_id='".$village_id."'");
	if($this->tbldata_exist("users","users_id","village_code='".$village_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['village_used'];
		$result = false;
		}
	//delete village
	if($result){
		$this->db_delete("village","village_id='".$village_id."'");
		//on delete
		}
  	return $result;
	}

function create_village($village_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($village_arr['village_code'])!="" && $this->tbldata_exist("village","village_id","village_code='".trim($village_arr['village_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['village_code'];
		$result = false;
		}
	//create village
	if($result){
		$this->db_insert("village",$village_arr);
		//on create
		}
  	return $result;
	}
	
function update_village($village_arr,$village_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($village_arr['village_code'])!="" && $this->tbldata_exist("village","village_id","village_code='".trim($village_arr['village_code'])."' AND village_id!='".$village_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['village_code'];
		$result = false;
		}
	//update village
	if($result){
		$this->db_update("village",$village_arr,"village_id='".$village_id."'");
		//on update
		}
  	return $result;
	}

//district
function delete_district($district_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$district_code=$this->db_fldrow("district","district_code","district_id='".$district_id."'");
	if($this->tbldata_exist("users","users_id","district_code='".$district_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['district_used'];
		$result = false;
		}
	//delete district
	if($result){
		$this->db_delete("district","district_id='".$district_id."'");
		//on delete
		}
  	return $result;
	}

function create_district($district_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($district_arr['district_code'])!="" && $this->tbldata_exist("district","district_id","district_code='".trim($district_arr['district_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['district_code'];
		$result = false;
		}
	//create district
	if($result){
		$this->db_insert("district",$district_arr);
		//on create
		}
  	return $result;
	}
	
function update_district($district_arr,$district_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($district_arr['district_code'])!="" && $this->tbldata_exist("district","district_id","district_code='".trim($district_arr['district_code'])."' AND district_id!='".$district_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['district_code'];
		$result = false;
		}
	//update district
	if($result){
		$this->db_update("district",$district_arr,"district_id='".$district_id."'");
		//on update
		}
  	return $result;
	}

//users_level_module
function delete_users_level_module($users_level_module_id)
	{
	$result = true;
	//validate
	//delete users_level_module
	if($result){
		$this->db_delete("users_level_module","users_level_module_id='".$users_level_module_id."'");
		//on delete
		}
  	return $result;
	}

function create_users_level_module($users_level_module_arr)
	{
	$result = true;
	//validate
	//create users_level_module
	if($result){
		$this->db_insert("users_level_module",$users_level_module_arr);
		//on create
		}
  	return $result;
	}
	
function update_users_level_module($users_level_module_arr,$users_level_module_id)
	{
	$result = true;
	//validate
	//update users_level_module
	if($result){
		$this->db_update("users_level_module",$users_level_module_arr,"users_level_module_id='".$users_level_module_id."'");
		//on update
		}
  	return $result;
	}

//users_level
function delete_users_level($users_level_id)
	{
	$result = true;
	//validate
	//delete users_level
	if($result){
		$users_level_code=$this->db_fldrow("users_level","users_level_code","users_level_id='".$users_level_id."'");
		$this->db_delete("users_level_module","users_level_code='".$users_level_code."'");
		$this->db_delete("users_level","users_level_id='".$users_level_id."'");
		//on delete
		}
  	return $result;
	}

function create_users_level($users_level_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($users_level_arr['users_level_code'])!="" && $this->tbldata_exist("users_level","users_level_id","users_level_code='".trim($users_level_arr['users_level_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['users_level_code'];
		$result = false;
		}
	//create users_level
	if($result){
		$this->db_insert("users_level",$users_level_arr);
		//on create
		}
  	return $result;
	}
	
function update_users_level($users_level_arr,$users_level_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($users_level_arr['users_level_code'])!="" && $this->tbldata_exist("users_level","users_level_id","users_level_code='".trim($users_level_arr['users_level_code'])."' AND users_level_id!='".$users_level_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['users_level_code'];
		$result = false;
		}
	//update users_level
	if($result){
		$this->db_update("users_level",$users_level_arr,"users_level_id='".$users_level_id."'");
		//on update
		}
  	return $result;
	}

//module_sub
function delete_module_sub($module_sub_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$module_sub_code=$this->db_fldrow("module_sub","module_sub_code","module_sub_id='".$module_sub_id."'");
	if($this->tbldata_exist("users_level_module","users_level_module_id","module_sub_code='".$module_sub_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['module_used'];
		$result = false;
		}
	//delete module_sub
	if($result){
		$this->db_delete("module_sub","module_sub_id='".$module_sub_id."'");
		//on delete
		}
  	return $result;
	}

function create_module_sub($module_sub_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($module_sub_arr['module_sub_code'])!="" && $this->tbldata_exist("module_sub","module_sub_id","module_sub_code='".trim($module_sub_arr['module_sub_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['module_sub_code'];
		$result = false;
		}
	//create module_sub
	if($result){
		$this->db_insert("module_sub",$module_sub_arr);
		//on create
		}
  	return $result;
	}
	
function update_module_sub($module_sub_arr,$module_sub_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($module_sub_arr['module_sub_code'])!="" && $this->tbldata_exist("module_sub","module_sub_id","module_sub_code='".trim($module_sub_arr['module_sub_code'])."' AND module_sub_id!='".$module_sub_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['module_sub_code'];
		$result = false;
		}
	//update module_sub
	if($result){
		$this->db_update("module_sub",$module_sub_arr,"module_sub_id='".$module_sub_id."'");
		//on update
		}
  	return $result;
	}

//module
function delete_module($module_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$module_code=$this->db_fldrow("module","module_code","module_id='".$module_id."'");
	if($this->tbldata_exist("module_sub","module_sub_id","module_code='".$module_code."'") && $this->tbldata_exist("users_level_module","users_level_module_id","module_code='".$module_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['module_used'];
		$result = false;
		}
	//delete module
	if($result){
		$this->db_delete("module","module_id='".$module_id."'");
		//on delete
		}
  	return $result;
	}

function create_module($module_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($module_arr['module_code'])!="" && $this->tbldata_exist("module","module_id","module_code='".trim($module_arr['module_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['module_code'];
		$result = false;
		}
	//create module
	if($result){
		$this->db_insert("module",$module_arr);
		//on create
		}
  	return $result;
	}
	
function update_module($module_arr,$module_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($module_arr['module_code'])!="" && $this->tbldata_exist("module","module_id","module_code='".trim($module_arr['module_code'])."' AND module_id!='".$module_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['module_code'];
		$result = false;
		}
	//update module
	if($result){
		$this->db_update("module",$module_arr,"module_id='".$module_id."'");
		//on update
		}
  	return $result;
	}

//staff
function delete_staff($staff_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	if($this->tbldata_exist("staff_orderdetails","staff_orderdetails_id","staff_id='".$staff_id."'")){
		$this->err_msg=$this->staff_order_lang['msgform_staff_order_lang']['staff_used'];
		$result = false;
		}
	//delete staff
	if($result){
		//unset thumbnail
		$staff_thumbnail=$this->db_fldrow("staff","staff_thumbnail","staff_id='".$staff_id."'");
		$staff_thumbnail_unlink=SITE_ROOT.$staff_thumbnail;
		unlink($staff_thumbnail_unlink);
		$this->db_delete("staff","staff_id='".$staff_id."'");
		//on delete
		}
  	return $result;
	}

function create_staff($staff_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($staff_arr['staff_code'])!="" && $this->tbldata_exist("staff","staff_id","staff_code='".trim($staff_arr['staff_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['staff_code'];
		$result = false;
		}
	//create staff
	if($result){
		$this->db_insert("staff",$staff_arr);
		//on create
		}
  	return $result;
	}
	
function update_staff($staff_arr,$staff_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($staff_arr['staff_code'])!="" && $this->tbldata_exist("staff","staff_id","staff_code='".trim($staff_arr['staff_code'])."' AND staff_id!='".$staff_id."'")){
		//$this->err_msg=$this->staff_order_lang['msgform_staff_order_lang']['staff_code'];
		//$result = false;
		}
	//update staff
	if($result){
		$this->db_update("staff",$staff_arr,"staff_id='".$staff_id."'");
		//on update
		}
  	return $result;
	}

//position
function delete_position($position_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$position_code=$this->db_fldrow("position","position_code","position_id='".$position_id."'");
	if($this->tbldata_exist("users","users_id","position_code='".$position_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['position_used'];
		$result = false;
		}
	//delete position
	if($result){
		$this->db_delete("position","position_id='".$position_id."'");
		//on delete
		}
  	return $result;
	}

function create_position($position_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($position_arr['position_code'])!="" && $this->tbldata_exist("position","position_id","position_code='".trim($position_arr['position_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['position_code'];
		$result = false;
		}
	//create position
	if($result){
		$this->db_insert("position",$position_arr);
		//on create
		}
  	return $result;
	}
	
function update_position($position_arr,$position_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($position_arr['position_code'])!="" && $this->tbldata_exist("position","position_id","position_code='".trim($position_arr['position_code'])."' AND position_id!='".$position_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['position_code'];
		$result = false;
		}
	//update position
	if($result){
		$this->db_update("position",$position_arr,"position_id='".$position_id."'");
		//on update
		}
  	return $result;
	}

//education
function delete_education($education_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$education_code=$this->db_fldrow("education","education_code","education_id='".$education_id."'");
	if($this->tbldata_exist("staff","staff_id","education_code='".$education_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['education_used'];
		$result = false;
		}
	//delete education
	if($result){
		$this->db_delete("education","education_id='".$education_id."'");
		//on delete
		}
  	return $result;
	}

function create_education($education_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($education_arr['education_code'])!="" && $this->tbldata_exist("education","education_id","education_code='".trim($education_arr['education_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['education_code'];
		$result = false;
		}
	//create education
	if($result){
		$this->db_insert("education",$education_arr);
		//on create
		}
  	return $result;
	}
	
function update_education($education_arr,$education_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($education_arr['education_code'])!="" && $this->tbldata_exist("education","education_id","education_code='".trim($education_arr['education_code'])."' AND education_id!='".$education_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['education_code'];
		$result = false;
		}
	//update education
	if($result){
		$this->db_update("education",$education_arr,"education_id='".$education_id."'");
		//on update
		}
  	return $result;
	}

//religion
function delete_religion($religion_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$religion_code=$this->db_fldrow("religion","religion_code","religion_id='".$religion_id."'");
	if($this->tbldata_exist("staff","staff_id","religion_code='".$religion_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['religion_used'];
		$result = false;
		}
	if($this->tbldata_exist("users","users_id","religion_code='".$religion_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['religion_used'];
		$result = false;
		}
	//delete religion
	if($result){
		$this->db_delete("religion","religion_id='".$religion_id."'");
		//on delete
		}
  	return $result;
	}

function create_religion($religion_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($religion_arr['religion_code'])!="" && $this->tbldata_exist("religion","religion_id","religion_code='".trim($religion_arr['religion_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['religion_code'];
		$result = false;
		}
	//create religion
	if($result){
		$this->db_insert("religion",$religion_arr);
		//on create
		}
  	return $result;
	}
	
function update_religion($religion_arr,$religion_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($religion_arr['religion_code'])!="" && $this->tbldata_exist("religion","religion_id","religion_code='".trim($religion_arr['religion_code'])."' AND religion_id!='".$religion_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['religion_code'];
		$result = false;
		}
	//update religion
	if($result){
		$this->db_update("religion",$religion_arr,"religion_id='".$religion_id."'");
		//on update
		}
  	return $result;
	}

//area
function delete_area($area_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$area_code=$this->db_fldrow("area","area_code","area_id='".$area_id."'");
	if($this->tbldata_exist("users","users_id","area_code='".$area_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['area_used'];
		$result = false;
		}
	//delete area
	if($result){
		$this->db_delete("area","area_id='".$area_id."'");
		//on delete
		}
  	return $result;
	}

function create_area($area_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($area_arr['area_code'])!="" && $this->tbldata_exist("area","area_id","area_code='".trim($area_arr['area_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['area_code'];
		$result = false;
		}
	//create area
	if($result){
		$this->db_insert("area",$area_arr);
		//on create
		}
  	return $result;
	}
	
function update_area($area_arr,$area_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($area_arr['area_code'])!="" && $this->tbldata_exist("area","area_id","area_code='".trim($area_arr['area_code'])."' AND area_id!='".$area_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['area_code'];
		$result = false;
		}
	//update area
	if($result){
		$this->db_update("area",$area_arr,"area_id='".$area_id."'");
		//on update
		}
  	return $result;
	}

//city
function delete_city($city_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$city_code=$this->db_fldrow("city","city_code","city_id='".$city_id."'");
	if($this->tbldata_exist("users","users_id","city_code='".$city_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['city_used'];
		$result = false;
		}
	//delete city
	if($result){
		$this->db_delete("city","city_id='".$city_id."'");
		//on delete
		}
  	return $result;
	}

function create_city($city_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($city_arr['city_code'])!="" && $this->tbldata_exist("city","city_id","city_code='".trim($city_arr['city_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['city_code'];
		$result = false;
		}
	//create city
	if($result){
		$this->db_insert("city",$city_arr);
		//on create
		}
  	return $result;
	}
	
function update_city($city_arr,$city_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($city_arr['city_code'])!="" && $this->tbldata_exist("city","city_id","city_code='".trim($city_arr['city_code'])."' AND city_id!='".$city_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['city_code'];
		$result = false;
		}
	//update city
	if($result){
		$this->db_update("city",$city_arr,"city_id='".$city_id."'");
		//on update
		}
  	return $result;
	}


//bank
function delete_bank($bank_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	if($this->tbldata_exist("users","users_id","bank_id='".$bank_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['bank_used'];
		$result = false;
		}
	//delete bank
	if($result){
		$this->db_delete("bank","bank_id='".$bank_id."'");
		//on delete
		}
  	return $result;
	}

function create_bank($bank_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($bank_arr['bank_code'])!="" && $this->tbldata_exist("bank","bank_id","bank_code='".trim($bank_arr['bank_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['bank_code'];
		$result = false;
		}
	//create bank
	if($result){
		$this->db_insert("bank",$bank_arr);
		//on create
		}
  	return $result;
	}
	
function update_bank($bank_arr,$bank_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($bank_arr['bank_code'])!="" && $this->tbldata_exist("bank","bank_id","bank_code='".trim($bank_arr['bank_code'])."' AND bank_id!='".$bank_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['bank_code'];
		$result = false;
		}
	//update bank
	if($result){
		$this->db_update("bank",$bank_arr,"bank_id='".$bank_id."'");
		//on update
		}
  	return $result;
	}

//contact
function delete_contact($contact_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	if($this->tbldata_exist("users","users_id","contact_id='".$contact_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['data_used'];
		$result = false;
		}
	//delete contact
	if($result){
		$this->db_delete("contact","contact_id='".$contact_id."'");
		//on delete
		}
  	return $result;
	}

function create_contact($contact_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($contact_arr['contact_code'])!="" && $this->tbldata_exist("contact","contact_id","contact_code='".trim($contact_arr['contact_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['data_redund'];
		$result = false;
		}
	if(trim($contact_arr['contact_username'])!="" && $this->tbldata_exist("contact","contact_id","contact_username='".trim($contact_arr['contact_username'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['data_redund'];
		$result = false;
		}
	//create contact
	if($result){
		$this->db_insert("contact",$contact_arr);
		//on create
		}
  	return $result;
	}
	
function update_contact($contact_arr,$contact_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($contact_arr['contact_code'])!="" && $this->tbldata_exist("contact","contact_id","contact_code='".trim($contact_arr['contact_code'])."' AND contact_id!='".$contact_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['data_redund'];
		$result = false;
		}
	if(trim($contact_arr['contact_username'])!="" && $this->tbldata_exist("contact","contact_id","contact_username='".trim($contact_arr['contact_username'])."' AND contact_id!='".$contact_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['data_redund'];
		$result = false;
		}
	//update contact
	if($result){
		$this->db_update("contact",$contact_arr,"contact_id='".$contact_id."'");
		//on update
		}
  	return $result;
	}


//users_group
function delete_users_group($users_group_id)
	{
	$result = true;
	//validate
	//if not related to others trs
	$users_group_code=$this->db_fldrow("users_group","users_group_code","users_group_id='".$users_group_id."'");
	if($this->tbldata_exist("users","users_id","users_group_code='".$users_group_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['users_group_used'];
		$result = false;
		}
	//delete users_group
	if($result){
		$this->db_delete("users_group","users_group_id='".$users_group_id."'");
		//on delete
		}
  	return $result;
	}

function create_users_group($users_group_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($users_group_arr['users_group_code'])!="" && $this->tbldata_exist("users_group","users_group_id","users_group_code='".trim($users_group_arr['users_group_code'])."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['users_group_code'];
		$result = false;
		}
	//create users_group
	if($result){
		$this->db_insert("users_group",$users_group_arr);
		//on create
		}
  	return $result;
	}
	
function update_users_group($users_group_arr,$users_group_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($users_group_arr['users_group_code'])!="" && $this->tbldata_exist("users_group","users_group_id","users_group_code='".trim($users_group_arr['users_group_code'])."' AND users_group_id!='".$users_group_id."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['users_group_code'];
		$result = false;
		}
	//update users_group
	if($result){
		$this->db_update("users_group",$users_group_arr,"users_group_id='".$users_group_id."'");
		//on update
		}
  	return $result;
	}
	
//asset fixed
function delete_users($users_id,$ext=0)
	{
	$result = true;
	//validate
	//if not related
	if($ext==0){
	//if not related to others trs
	$users_code=$this->db_fldrow("users","users_code","users_id='".$users_id."'");
	//company
	if($this->tbldata_exist("company","*","astra_code='".$users_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['related_trs'];
		$result = false;
		}
	//service_order
	if($this->tbldata_exist("service_order","*","users_code='".$users_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['related_trs'];
		$result = false;
		}
	//product_order
	if($this->tbldata_exist("product_order","*","users_code='".$users_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['related_trs'];
		$result = false;
		}
	//motorcycle
	if($this->tbldata_exist("motorcycle","*","users_code='".$users_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['related_trs'];
		$result = false;
		}
	//utang piutang dll
	if($this->tbldata_exist("payreceivable","*","users_code='".$users_code."'")){
		$this->err_msg=$this->users_lang['msgform_users_lang']['related_trs'];
		$result = false;
		}}
	//delete
	if($result){
		$this->db_delete("users","users_id='".$users_id."'");
		//on delete
		}
  	return $result;
	}

function create_users($users_arr)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($users_arr['users_code'])=="" || (trim($users_arr['users_code'])!="" && $this->tbldata_exist("users","*","users_code='".$users_arr['users_code']."'"))){
		$this->err_msg=$this->users_lang['form_label_users_lang']['users_redundant'];
		$result = false;
		}
	//create users
	if($result){
		$this->db_insert("users",$users_arr);
		//on create
		}
  	return $result;
	}
	
function update_users($users_arr,$users_id)
	{
	$result = true;
	//validate
	//if not redundant code
	if(trim($users_arr['users_code'])=="" || (trim($users_arr['users_code'])!="" && $this->tbldata_exist("users","*","users_code='".$users_arr['users_code']."' AND users_id!='".$users_id."'"))){
		$this->err_msg=$this->users_lang['form_label_users_lang']['users_redundant'];
		$result = false;
		}
	//create users
	if($result){
		//before post
		$this->db_update("users",$users_arr,"users_id='".$users_id."'");
		//on update
		}
  	return $result;
	}
	
//code generator
function generator_code($str_code,$str_add_def,$substr_ind=10,$str_add_ind=5)
	{
	$str = substr($str_code, $substr_ind);
	
	if($str==""){
		$str = 1;
		}else{
		$str = ltrim($str, '0')+1;
		}
	$str_add=$str_add_ind-strlen($str);
	$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
	return $str_add_def.$str2;
	}
	
//code generator
function generator_code_auto($str_id,$str_add_def,$substr_ind=10,$str_add_ind=5)
	{
	$str = $str_id;
	$str_add=$str_add_ind-strlen($str);
	$str2 = str_pad($str,(strlen($str) + $str_add),"0",STR_PAD_LEFT);
	return $str_add_def.$str2;
	}
	
//customer code generator
function generator_customer()
	{
	$db_select = $this->db_select("users","users_code","users_type='customer' AND users_code LIKE 'CUS%' AND LENGTH(users_code) = 8","users_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$users_code=$select_data[0]['users_code'];
	return $this->generator_code($users_code,"CUS",3,5);
	}
	
//vendor code generator
function generator_vendor()
	{
	$db_select = $this->db_select("users","users_code","users_type='vendor' AND users_code LIKE 'VND%' AND LENGTH(users_code) = 8","users_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$users_code=$select_data[0]['users_code'];
	return $this->generator_code($users_code,"VND",3,5);
	}
	
//supplier code generator
function generator_supplier()
	{
	$db_select = $this->db_select("users","users_code","users_type='supplier' AND users_code LIKE 'SUP%' AND LENGTH(users_code) = 8","users_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$users_code=$select_data[0]['users_code'];
	return $this->generator_code($users_code,"SUP",3,5);
	}
	
//staff code generator
function generator_staff()
	{
	$db_select = $this->db_select("staff","staff_code","staff_code LIKE 'KAR%' AND LENGTH(staff_code) = 8","staff_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$staff_code=$select_data[0]['staff_code'];
	return $this->generator_code($staff_code,"KAR",3,5);
	}
	
//users code generator
function generator_kontak_code()
	{
	$db_select = $this->db_select("users","users_code","users_type!='member' AND users_type!='fictive' AND users_type!='candidate'","users_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$deposit_code=$select_data[0]['users_code'];
	
	return $this->generator_code($deposit_code,"KNT");
	}

//village code generator
function generator_village()
	{
	$db_select = $this->db_select("village","village_code","village_code LIKE 'KEL%' AND LENGTH(village_code) = 8","village_id DESC",0,1);
	$select_data=$db_select['select_data'];
	$village_code=$select_data[0]['village_code'];
	return $this->generator_code($village_code,"KEL",3,5);
	}
}
?>
