<?php
require_once SITE_ROOT . "book/models/book/book.class.php";
require_once SITE_ROOT . "payreceivable/models/payreceivable/payreceivable.class.php";
class salary extends global_class
{
    public $book;
    public $salary_lang;
    public function __construct()
    {
        include SITE_ROOT . "config/global.php";
        include SITE_ROOT . "salary/lang/" . $glob_config['db_config']['lang'] . "/lang.php";
        parent::__construct();
        $this->book          = new book();
        $this->payreceivable = new payreceivable();
        $this->salary_lang   = $salary_lang;
    }

//salary_daily_target
    public function update_salary_daily_target($salary_daily_target_arr, $salary_daily_target_id)
    {
        $result = true;
        //validate
        //update salary_daily_target
        if ($result) {
            $this->db_update("salary_daily_target", $salary_daily_target_arr, "salary_daily_target_id='" . $salary_daily_target_id . "'");
            //on update
        }
        return $result;
    }

//salary_target
    public function update_salary_target($salary_target_arr, $salary_target_id)
    {
        $result = true;
        //validate
        //update salary_target
        if ($result) {
            $this->db_update("salary_target", $salary_target_arr, "salary_target_id='" . $salary_target_id . "'");
            //on update
        }
        return $result;
    }

//absence_penalty
    public function update_absence_penalty($absence_penalty_arr, $absence_penalty_id)
    {
        $result = true;
        //validate
        //update absence_penalty
        if ($result) {
            $this->db_update("absence_penalty", $absence_penalty_arr, "absence_penalty_id='" . $absence_penalty_id . "'");
            //on update
        }
        return $result;
    }

//company
    public function update_company($company_arr, $company_id)
    {
        $result = true;
        //validate
        //update company
        if ($result) {
            $this->db_update("company", $company_arr, "company_id='" . $company_id . "'");
            //on update
        }
        return $result;
    }

//salary_slip
    public function delete_salary_slip($salary_slip_id)
    {
        $result = true;
        //validate
        //if not related to others trs
        //delete salary_slip
        if ($result) {
            //clear
            $salary_slip_row              = $this->db_row_join("salary_slip", "payreceivable_cashbon_id,payreceivable_payable_id,ledger_id", "salary_slip_id='" . $salary_slip_id . "'");
            $payreceivable_cashbon_id_arr = explode(",", $salary_slip_row['payreceivable_cashbon_id']);
            for ($i = 0; $i < count($payreceivable_cashbon_id_arr); $i++) {
                $this->payreceivable->delete_receivable($payreceivable_cashbon_id_arr[$i]);
            }
            $payreceivable_payable_id_arr = explode(",", $salary_slip_row['payreceivable_payable_id']);
            for ($j = 0; $j < count($payreceivable_payable_id_arr); $j++) {
                $this->payreceivable->delete_receivable($payreceivable_payable_id_arr[$j]);
            }
            $this->db_delete("ledgerdetails", "ledger_id='" . $salary_slip_row['ledger_id'] . "'");
            $this->db_delete("ledger", "ledger_id='" . $salary_slip_row['ledger_id'] . "'");
            $this->db_delete("salary_slip", "salary_slip_id='" . $salary_slip_id . "'");
            //on delete
        }
        return $result;
    }

    public function pay_active_cashbon($cashbon_amount, $staff_code, $date_registernum)
    {
        //get cashbon residu
        $cashbon_residu       = $cashbon_amount;
        $payreceivable_id_set = "";
        //loop active cashbon
        $db_select   = $this->db_select("payreceivable", "*", "payreceivable_type='1' AND payreceivable_status='0' AND payreceivable_paid_status='0' AND staff_code='" . $staff_code . "' AND payreceivable_registernum <= '" . $date_registernum . "'", "", 0, 0);
        $select_data = $db_select['select_data'];
        for ($i = 0; $i < $db_select['select_num']; $i++) {
            //if non tenor
            $paid_amount = $this->payreceivable->get_receivable_paid($select_data[$i]['payreceivable_code']);
            if ($select_data[$i]['payreceivable_tenor'] <= 1) {
                $receivable_balance_cashbon  = $select_data[$i]['payreceivable_amount'] - $paid_amount;
                $payreceivable_accountdebit  = $this->book->account_special_get("cash");
                $payreceivable_accountcredit = $this->book->account_special_get("receivable_staff");
                //if cashbon residu>= active cashbon amount
                if ($cashbon_residu > 0) {
                    //pay cashbon
                    $payreceivable_amount = $receivable_balance_cashbon;
                    if ($receivable_balance_cashbon > $cashbon_residu) {
                        $payreceivable_amount = $cashbon_residu;
                    }
                    //cek if lunas
                    $payreceivable_paid_status = 0;
                    if ($receivable_balance_cashbon == $payreceivable_amount) {
                        $payreceivable_paid_status = 1;
                    }
                    //insert payreceivable
                    $create_arr = [
                        'staff_code'                  => $staff_code,
                        'payreceivable_register'      => $this->date_numtostr($date_registernum),
                        'payreceivable_registernum'   => $date_registernum,
                        'payreceivable_description'   => "Pembayaran Cash Bon",
                        'payreceivable_amount'        => $payreceivable_amount,
                        'payreceivable_uneditable'    => 0,
                        'payreceivable_accountdebit'  => $payreceivable_accountdebit,
                        'payreceivable_accountcredit' => $payreceivable_accountcredit,
                        'payreceivable_type'          => 1,
                        'payreceivable_status'        => 1,
                        'payrecievable_set_id'        => $select_data[$i]['payreceivable_id'],
                    ];
                    //print_r($create_arr);
                    //create receivable payment
                    if (! $this->payreceivable->create_receivable($create_arr, 0)) {
                        $this->payreceivable->error_message($this->payreceivable->err_msg);
                    } else {
                        $payreceivable_id = $this->db_lastid("payreceivable", "payreceivable_id");
                        $payreceivable_id_set .= $payreceivable_id . ",";
                        $payreceivable_code = $this->db_fldrow("payreceivable", "payreceivable_code", "payreceivable_id='" . $payreceivable_id . "'");
                        $cashbon_residu -= $payreceivable_amount;
                        //insert payreceivable_details
                        $insert_arr = [
                            'payreceivable_id'             => $select_data[$i]['payreceivable_id'],
                            'payreceivable_code'           => $select_data[$i]['payreceivable_code'],
                            'payreceivable_details_amount' => $payreceivable_amount,
                            'payreceivable_rel_id'         => $payreceivable_id,
                        ];
                        //print_r($insert_arr);
                        $this->db_insert("payreceivable_details", $insert_arr);
                        $update_arr = [
                            'payreceivable_paid_status ' => $payreceivable_paid_status,
                        ];
                        $this->db_update("payreceivable", $update_arr, "payreceivable_id='" . $select_data[$i]['payreceivable_id'] . "'");
                    }
                }
            }
        }
        return $payreceivable_id_set;
    }

    public function pay_active_payable($payable_amount, $staff_code, $date_registernum)
    {
        //get payable residu
        $payable_residu       = $payable_amount;
        $payreceivable_id_set = "";
        //loop active payable
        $db_select   = $this->db_select("payreceivable", "*", "payreceivable_type='1' AND payreceivable_status='0' AND payreceivable_paid_status='0' AND staff_code='" . $staff_code . "' AND payreceivable_registernum <= '" . $date_registernum . "'", "", 0, 0);
        $select_data = $db_select['select_data'];
        for ($i = 0; $i < $db_select['select_num']; $i++) {
            //if non tenor
            $paid_amount = $this->payreceivable->get_receivable_paid($select_data[$i]['payreceivable_code']);
            if ($select_data[$i]['payreceivable_tenor'] > 1) {
                $receivable_balance_payabl_tot = $select_data[$i]['payreceivable_amount'] - $paid_amount;
                $receivable_balance_payable    = $receivable_balance_payabl_tot / $select_data[$i]['payreceivable_tenor'];
                $payreceivable_accountdebit    = $this->book->account_special_get("cash");
                $payreceivable_accountcredit   = $this->book->account_special_get("receivable_staff");
                //if payable residu>= active payable amount
                if ($payable_residu > 0) {
                    //pay payable
                    $payreceivable_amount = $receivable_balance_payable;
                    if ($receivable_balance_payable > $payable_residu) {
                        $payreceivable_amount = $payable_residu;
                    }
                    //cek if lunas
                    $payreceivable_paid_status = 0;
                    if ($receivable_balance_payabl_tot == $payreceivable_amount) {
                        $payreceivable_paid_status = 1;
                    }
                    //insert payreceivable
                    $create_arr = [
                        'staff_code'                  => $staff_code,
                        'payreceivable_register'      => $this->date_numtostr($date_registernum),
                        'payreceivable_registernum'   => $date_registernum,
                        'payreceivable_description'   => "Pembayaran Utang Karyawan",
                        'payreceivable_amount'        => $payreceivable_amount,
                        'payreceivable_uneditable'    => 0,
                        'payreceivable_accountdebit'  => $payreceivable_accountdebit,
                        'payreceivable_accountcredit' => $payreceivable_accountcredit,
                        'payreceivable_type'          => 1,
                        'payreceivable_status'        => 1,
                        'payrecievable_set_id'        => $select_data[$i]['payreceivable_id'],
                    ];
                    //print_r($create_arr);
                    //create receivable payment
                    if (! $this->payreceivable->create_receivable($create_arr, 0)) {
                        $this->payreceivable->error_message($this->payreceivable->err_msg);
                    } else {
                        $payreceivable_id = $this->db_lastid("payreceivable", "payreceivable_id");
                        $payreceivable_id_set .= $payreceivable_id . ",";
                        $payreceivable_code = $this->db_fldrow("payreceivable", "payreceivable_code", "payreceivable_id='" . $payreceivable_id . "'");
                        $payable_residu -= $payreceivable_amount;
                        //insert payreceivable_details
                        $insert_arr = [
                            'payreceivable_id'             => $select_data[$i]['payreceivable_id'],
                            'payreceivable_code'           => $select_data[$i]['payreceivable_code'],
                            'payreceivable_details_amount' => $payreceivable_amount,
                            'payreceivable_rel_id'         => $payreceivable_id,
                        ];
                        //print_r($insert_arr);
                        $this->db_insert("payreceivable_details", $insert_arr);
                        $update_arr = [
                            'payreceivable_paid_status ' => $payreceivable_paid_status,
                        ];
                        $this->db_update("payreceivable", $update_arr, "payreceivable_id='" . $select_data[$i]['payreceivable_id'] . "'");
                    }
                }
            }
        }
        return $payreceivable_id_set;
    }

    public function create_salary_slip($salary_slip_arr)
    {
        $result = true;
        //validate
        //if not redundant code
        //create salary_slip
        if ($result) {
            //update cash bon
            $salary_slip_monthstrip                      = $this->month_strtostrip($salary_slip_arr['salary_slip_month']);
            $salary_slip_datenum                         = date("t", strtotime($salary_slip_monthstrip . "-01"));
            $date_register                               = $salary_slip_datenum . "/" . $salary_slip_arr['salary_slip_month'];
            $date_registernum                            = $salary_slip_arr['salary_slip_monthnum'] . $salary_slip_datenum;
            $salary_slip_arr['payreceivable_cashbon_id'] = $this->pay_active_cashbon($salary_slip_arr['salary_slip_cut_cashbon'], $salary_slip_arr['staff_code'], $date_registernum);
            //update payable
            $salary_slip_arr['payreceivable_payable_id'] = $this->pay_active_payable($salary_slip_arr['salary_slip_cut_payable'], $salary_slip_arr['staff_code'], $date_registernum);
            //post ledger
            $accountdebit                 = $this->book->account_special_get("salary_staff");
            $accountcredit                = $this->book->account_special_get("cash");
            $ledger_description           = "Pembayaran Gaji - " . $salary_slip_arr['staff_code'] . " - " . $salary_slip_arr['salary_slip_month'];
            $set_rekening                 = [$accountdebit, "D", $salary_slip_arr['salary_total'], $accountcredit, "K", $salary_slip_arr['salary_total']];
            $salary_slip_arr['ledger_id'] = $this->book->ledger_post($date_register, 1, $ledger_description, $set_rekening, $date_registernum, 0);
            //unset
            unset($salary_slip_arr['salary_total']);
            //insert
            $this->db_insert("salary_slip", $salary_slip_arr);
            //on create
        }
        return $result;
    }

    public function update_salary_slip($salary_slip_arr, $salary_slip_id)
    {
        $result = true;
        //validate
        //if not redundant code
        //update salary_slip
        if ($result) {
            //clear old
            $salary_slip_row              = $this->db_row_join("salary_slip", "payreceivable_cashbon_id,payreceivable_payable_id,ledger_id", "salary_slip_id='" . $salary_slip_id . "'");
            $payreceivable_cashbon_id_arr = explode(",", $salary_slip_row['payreceivable_cashbon_id']);
            for ($i = 0; $i < count($payreceivable_cashbon_id_arr); $i++) {
                $this->payreceivable->delete_receivable($payreceivable_cashbon_id_arr[$i]);
            }
            $payreceivable_payable_id_arr = explode(",", $salary_slip_row['payreceivable_payable_id']);
            for ($j = 0; $j < count($payreceivable_payable_id_arr); $j++) {
                $this->payreceivable->delete_receivable($payreceivable_payable_id_arr[$j]);
            }
            //update cash bon
            $salary_slip_monthstrip                      = $this->month_strtostrip($salary_slip_arr['salary_slip_month']);
            $salary_slip_datenum                         = date("t", strtotime($salary_slip_monthstrip . "-01"));
            $date_register                               = $salary_slip_datenum . "/" . $salary_slip_arr['salary_slip_month'];
            $date_registernum                            = $salary_slip_arr['salary_slip_monthnum'] . $salary_slip_datenum;
            $salary_slip_arr['payreceivable_cashbon_id'] = $this->pay_active_cashbon($salary_slip_arr['salary_slip_cut_cashbon'], $salary_slip_arr['staff_code'], $date_registernum);
            //update payable
            $salary_slip_arr['payreceivable_payable_id'] = $this->pay_active_payable($salary_slip_arr['salary_slip_cut_payable'], $salary_slip_arr['staff_code'], $date_registernum);
            //post ledger
            $accountdebit       = $this->book->account_special_get("salary_staff");
            $accountcredit      = $this->book->account_special_get("cash");
            $ledger_description = "Pembayaran Gaji - " . $salary_slip_arr['staff_code'] . " - " . $salary_slip_arr['salary_slip_month'];
            $set_rekening       = [$accountdebit, "D", $salary_slip_arr['salary_total'], $accountcredit, "K", $salary_slip_arr['salary_total']];
            $this->book->ledgerdesc_update($salary_slip_row['ledger_id'], $ledger_description, $date_register, $date_registernum, 0, 0);
            $this->book->ledgerdetails_update($salary_slip_row['ledger_id'], $date_register, $set_rekening);
            $salary_slip_arr['ledger_id'] = $salary_slip_row['ledger_id'];
            //unset
            unset($salary_slip_arr['salary_total']);
            //update
            $this->db_update("salary_slip", $salary_slip_arr, "salary_slip_id='" . $salary_slip_id . "'");
            //on update
        }
        return $result;
    }

//auto generate absence
    public function generate_absence($month_year)
    {
//select service order
        $service_order_row = $this->db_qry_data("SELECT service_order_register FROM service_order WHERE service_order_register LIKE '%" . $month_year . "' GROUP BY service_order_registernum ORDER BY service_order_registernum ASC");
        for ($i = 0; $i < count($service_order_row['select_data']); $i++) {
            //select staff
            $absence_date      = $this->date_stridtonum($service_order_row['select_data'][$i]['service_order_register']);
            $company_row       = $this->db_row("company", "*", "");
            $absence_work_in   = $absence_date . " " . $company_row['company_work_in'];
            $absence_work_out  = $absence_date . " " . $company_row['company_work_out'];
            $absence_break_in  = $absence_date . " " . $company_row['company_break_in'];
            $absence_break_out = $absence_date . " " . $company_row['company_break_out'];
            $staff_order_row   = $this->db_qry_data("SELECT staff_code FROM staff ORDER BY staff_code ASC");
            for ($j = 0; $j < count($staff_order_row['select_data']); $j++) {
                //insert items
                $create_arr = [
                    'staff_code'        => $staff_order_row['select_data'][$j]['staff_code'],
                    'absence_date'      => $absence_date,
                    'absence_work_in'   => $absence_work_in,
                    'absence_work_out'  => $absence_work_out,
                    'absence_break_in'  => $absence_break_in,
                    'absence_break_out' => $absence_break_out,
                    'absence_status'    => "none",
                ];
                if (! ($this->tbldata_exist("absence", "absence_id", "staff_code='" . $staff_order_row['select_data'][$j]['staff_code'] . "' AND absence_date='" . $absence_date . "'", $result_row))) {
                    //print_r($create_arr);
                    if (! $this->create_absence($create_arr)) {
                        $this->error_message($this->salary->err_msg);
                    }
                }
            }
        } //end service order
    }

//absence
    public function delete_absence($absence_id)
    {
        $result = true;
        //validate
        //if not related to others trs
        //delete absence
        if ($result) {
            $this->db_delete("absence", "absence_id='" . $absence_id . "'");
            /*
		$absence_arr = array(
		'absence_status'=>	"none",
		);
		$this->db_update("absence",$absence_arr,"absence_id='".$absence_id."'");
		*/
            //on delete
        }
        return $result;
    }

    public function create_absence($absence_arr)
    {
        $result = true;
        //validate
        //if not redundant code
        //create absence
        if ($result) {
            $this->db_insert("absence", $absence_arr);
            //on create
        }
        return $result;
    }

    public function update_absence($absence_arr, $absence_id)
    {
        $result = true;
        //validate
        //if not redundant code
        //update absence
        if ($result) {
            $this->db_update("absence", $absence_arr, "absence_id='" . $absence_id . "'");
            //on update
        }
        return $result;
    }

//get absence
    public function get_absence($staff_code, $salary_slip_monthstrip)
    {
        $start_date = $salary_slip_monthstrip . "-01";
        $end_date   = $salary_slip_monthstrip . "-31";
        //output
        $get_absence_arr = [];
        //get absence_penalty
        $absence_penalty_select = $this->db_select("absence_penalty", "*", "absence_penalty_type='work'", "", 0, 4);
        $absence_penalty_data   = $absence_penalty_select['select_data'];
        //get absence_penalty break
        $absence_penalty_select2 = $this->db_select("absence_penalty", "*", "absence_penalty_type='break'", "", 0, 1);
        $absence_penalty_data2   = $absence_penalty_select2['select_data'];
        //company
        $company_row = $this->db_row("company", "*", "");
        //init
        $salary_slip_cut_late         = 0;
        $salary_slip_cut_alfa         = 0;
        $salary_slip_insentif_no_alfa = 0;
        $absence_row                  = $this->db_qry_data("SELECT absence.absence_work,absence.absence_permission,absence.absence_sick,absence.absence_alfa,absence.absence_not_work,absence.absence_holiday,absence.absence_description,absence.absence_work_mlate1,absence.absence_work_mlate2,absence.absence_work_mlate3,absence.absence_work_mlate4,absence.absence_break_mlate1 FROM staff LEFT JOIN (SELECT position_name,position_code FROM position) position ON staff.position_code = position.position_code LEFT JOIN (SELECT *,COUNT(CASE WHEN absence_status LIKE 'work' THEN 1 END) AS absence_work,COUNT(CASE WHEN absence_status LIKE 'permission' THEN 1 END) AS absence_permission,COUNT(CASE WHEN absence_status LIKE 'sick' THEN 1 END) AS absence_sick,COUNT(CASE WHEN absence_status LIKE 'alfa' THEN 1 END) AS absence_alfa,COUNT(CASE WHEN absence_status != 'work' THEN 1 END) AS absence_not_work,COUNT(CASE WHEN absence_status LIKE 'holiday' THEN 1 END) AS absence_holiday,COUNT(CASE WHEN absence_status = 'work' AND absence_work_mlate BETWEEN '5' AND '" . $absence_penalty_data[0]['absence_penalty_mlate'] . "' THEN 1 END) AS absence_work_mlate1,COUNT(CASE WHEN absence_status = 'work' AND absence_work_mlate BETWEEN '" . $absence_penalty_data[0]['absence_penalty_mlate'] . "' AND '" . $absence_penalty_data[1]['absence_penalty_mlate'] . "' THEN 1 END) AS absence_work_mlate2,COUNT(CASE WHEN absence_status = 'work' AND absence_work_mlate BETWEEN '" . $absence_penalty_data[1]['absence_penalty_mlate'] . "' AND '" . $absence_penalty_data[2]['absence_penalty_mlate'] . "' THEN 1 END) AS absence_work_mlate3,COUNT(CASE WHEN absence_status = 'work' AND absence_work_mlate > '" . $absence_penalty_data[2]['absence_penalty_mlate'] . "' THEN 1 END) AS absence_work_mlate4,COUNT(CASE WHEN absence_status = 'work' AND absence_break_mlate > '" . $absence_penalty_data2[0]['absence_penalty_mlate'] . "' THEN 1 END) AS absence_break_mlate1 FROM absence WHERE (absence.absence_date BETWEEN '" . $start_date . "' AND '" . $end_date . "') GROUP BY staff_code) absence ON staff.staff_code = absence.staff_code WHERE staff.staff_code ='" . $staff_code . "' ORDER BY staff.staff_code ASC");
        for ($i = 0; $i < count($absence_row['select_data']); $i++) {
            $salary_slip_cut_late = ($absence_row['select_data'][$i]['absence_work_mlate1'] * $absence_penalty_data[0]['absence_penalty_amount']) + ($absence_row['select_data'][$i]['absence_work_mlate2'] * $absence_penalty_data[1]['absence_penalty_amount']) + ($absence_row['select_data'][$i]['absence_work_mlate3'] * $absence_penalty_data[2]['absence_penalty_amount']) + ($absence_row['select_data'][$i]['absence_work_mlate4'] * $absence_penalty_data[3]['absence_penalty_amount']) + ($absence_row['select_data'][$i]['absence_break_mlate1'] * $absence_penalty_data2[0]['absence_penalty_amount']);
            $salary_slip_cut_alfa = ($absence_row['select_data'][$i]['absence_alfa'] * $company_row['company_alfa_pinalty']);
            if ($absence_row['select_data'][$i]['absence_not_work'] <= 0) {
                $salary_slip_insentif_no_alfa = $company_row['company_insentif_no_alfa'];
            }
        }
        $get_absence_arr['salary_slip_cut_late']         = $salary_slip_cut_late;
        $get_absence_arr['salary_slip_cut_alfa']         = $salary_slip_cut_alfa;
        $get_absence_arr['salary_slip_insentif_no_alfa'] = $salary_slip_insentif_no_alfa;
        return $get_absence_arr;
    }

    public function get_service_fee_list($staff_code, $register_start, $register_end)
    {
        $start_date         = $register_start;
        $end_date           = $register_end;
        $service_fee_amount = 0;
        $service_fee_row    = $this->db_qry_data("SELECT service_orderdetails_price,service.service_bprice as service_bprice,service_orderdetails_quantity,service.service_commission_percent as service_commission_percent,service_order.service_order_code,
staff.staff_name,service.service_code as service_code,
(CASE
WHEN service.service_commission_type='percent' THEN ((((service_orderdetails_total/service_orderdetails_quantity)-service.service_bprice)*service_orderdetails_quantity)*(service.service_commission_percent/100))
WHEN service.service_commission_type='nominal' THEN service.service_commission_nominal*service_orderdetails_quantity
ELSE 'no'
END) AS service_fee_amount
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
WHERE staff.staff_code ='" . $staff_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
ORDER BY service_order.service_order_code ASC");
        $return_arr = [];
        for ($i = 0; $i < count($service_fee_row['select_data']); $i++) {
            $fee_amount = $service_fee_row['select_data'][$i]['service_fee_amount'] < 0
                ? 0
                : $service_fee_row['select_data'][$i]['service_fee_amount'];
            $return_arr[] = $service_fee_row['select_data'][$i]['service_code'] . '::' . $service_fee_row['select_data'][$i]['service_orderdetails_price'] . '::' . $service_fee_row['select_data'][$i]['service_bprice'] . '::' . $service_fee_row['select_data'][$i]['service_orderdetails_quantity'] . '::' . $service_fee_row['select_data'][$i]['service_commission_percent'] . '::' . $fee_amount;
        }
        return $return_arr;
    }

//get service fee
    public function get_service_fee($staff_code, $register_start, $register_end)
    {
        $start_date         = $register_start;
        $end_date           = $register_end;
        $service_fee_amount = 0;
        $service_fee_row    = $this->db_qry_data("SELECT service_order.service_order_code,
staff.staff_name,service.service_code,
(CASE
WHEN service.service_commission_type='percent' THEN ((((service_orderdetails_total/service_orderdetails_quantity)-service.service_bprice)*service_orderdetails_quantity)*(service.service_commission_percent/100))
WHEN service.service_commission_type='nominal' THEN service.service_commission_nominal*service_orderdetails_quantity
ELSE 'no'
END) AS service_fee_amount
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
WHERE staff.staff_code ='" . $staff_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
ORDER BY service_order.service_order_code ASC");
        for ($i = 0; $i < count($service_fee_row['select_data']); $i++) {
            $fee_amount = $service_fee_row['select_data'][$i]['service_fee_amount'] < 0
                ? 0
                : $service_fee_row['select_data'][$i]['service_fee_amount'];
            $service_fee_amount += $fee_amount;
        }
        return $service_fee_amount;
    }

//get product fee
    public function get_product_fee($staff_code, $register_start, $register_end)
    {
        $start_date         = $register_start;
        $end_date           = $register_end;
        $product_fee_amount = 0;
        $product_amount = 0;
        $product_fee_row    = $this->db_qry_data("SELECT service_order.service_order_code,
staff.staff_name,product.product_code,
(CASE
WHEN product.product_commission_type='percent' THEN ((product_orderdetails_total)*(product.product_commission_percent/100))
WHEN product.product_commission_type='nominal' THEN product.product_commission_nominal*product_orderdetails_quantity
ELSE 'no'
END) AS product_fee_amount,
(product_orderdetails_total) AS product_amount
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
LEFT JOIN product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
LEFT JOIN product ON product_orderdetails.product_code = product.product_code
WHERE staff.staff_code ='" . $staff_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
ORDER BY service_order.service_order_code ASC");
        for ($i = 0; $i < count($product_fee_row['select_data']); $i++) {
            $product_fee_amount += $product_fee_row['select_data'][$i]['product_fee_amount'];
            $product_amount += $product_fee_row['select_data'][$i]['product_amount'];
        }
        if($product_amount<25000000){
            $product_fee_amount = 0;
        }
        return $product_fee_amount;
    }

//get insentif
    public function get_daily_insentif($staff_code, $register_start, $register_end)
    {
        // $start_date=intval($salary_slip_monthnum."01");
        // $end_date=intval($salary_slip_monthnum."31");
        $valid_date_start           = $this->valid_date($register_start);
        $valid_date_end             = $this->valid_date($register_end);
        $start_date                 = $valid_date_start['date_registernum'];
        $end_date                   = $valid_date_end['date_registernum'];
        $salary_daily_target_amount = 0;
        $get_insentif_arr           = [];
        $pit_arr                    = [];
        $num_work                   = 0;
        $daily_insentif_row         = $this->db_qry_data("SELECT service_order.service_order_register,COUNT(DISTINCT staff.staff_code) AS mechanic_num_all,
SUM(if(staff.staff_code = '" . $staff_code . "', 1, 0)) AS mechanic_if_selected,
SUM(service_orderdetails.service_orderdetails_total) AS amount_service,
SUM(product_orderdetails.product_orderdetails_total) AS amount_product
FROM service_order
LEFT JOIN (SELECT * FROM staff) staff ON service_order.staff_code = staff.staff_code
LEFT JOIN (SELECT service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total FROM service_orderdetails GROUP BY service_order_id) service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN (SELECT service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total FROM product_orderdetails GROUP BY service_order_id) product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
WHERE (service_order.service_order_registernum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
GROUP BY service_order.service_order_registernum
ORDER BY service_order.service_order_registernum ASC");
        for ($i = 0; $i < count($daily_insentif_row['select_data']); $i++) {

            $absence_date = $this->date_stridtonum($daily_insentif_row['select_data'][$i]['service_order_register']);
            if ($this->tbldata_exist("absence", "absence_id", "absence_date='" . $absence_date . "' AND staff_code = '" . $staff_code . "' AND absence_status='work'")) {
                $num_work++;
            }

            if ($daily_insentif_row['select_data'][$i]['mechanic_if_selected'] > 0) {
                $daily_achievement = $daily_insentif_row['select_data'][$i]['amount_service'] + $daily_insentif_row['select_data'][$i]['amount_product'];
                //$get_insentif_arr[]['daily_achievement']=$daily_achievement;
                $db_select_daily_target   = $this->db_select("salary_daily_target", "*", "", "", 0, 0);
                $select_data_daily_target = $db_select_daily_target['select_data'];
                for ($i_dt = 0; $i_dt < $db_select_daily_target['select_num']; $i_dt++) {
                    $salary_daily_target_min = $select_data_daily_target[$i_dt]['salary_daily_target_min'];
                    $salary_daily_target_max = $select_data_daily_target[$i_dt]['salary_daily_target_max'];
                    if ($daily_achievement >= $salary_daily_target_min && $daily_achievement < $salary_daily_target_max) {
                        //$get_insentif_arr[]['salary_daily_target_amount']=$select_data_daily_target[$i_dt]['salary_daily_target_amount'];
                        $salary_daily_target_amount += $select_data_daily_target[$i_dt]['salary_daily_target_amount'];
                    }
                }
            }
        }
        $pit_arr['salary_daily_target_amount'] = $salary_daily_target_amount;
        $pit_arr['num_work']                   = $num_work;
        return $pit_arr;
        //return $salary_daily_target_amount;
        //return $get_insentif_arr;
    }

//get comission
    public function get_comission($staff_code, $start_date, $end_date)
    {
        $start_date = intval($start_date);
        $end_date   = intval($end_date);
        //output
        $get_insentif_arr = [];
        //get salary_target ue
        $salary_target_select = $this->db_select("salary_target", "*", "salary_target_type='ue'", "", 0, 3);
        $salary_target_data   = $salary_target_select['select_data'];
        //get salary_target service
        $salary_target_select2 = $this->db_select("salary_target", "*", "salary_target_type='service'", "", 0, 3);
        $salary_target_data2   = $salary_target_select2['select_data'];
        //get salary_target product
        $salary_target_select3 = $this->db_select("salary_target", "*", "salary_target_type='product'", "", 0, 3);
        $salary_target_data3   = $salary_target_select3['select_data'];
        //company
        $company_row = $this->db_row("company", "*", "");
        //init
        $salary_slip_insentif_unit_entry = 0;
        $salary_slip_insentif_service    = 0;
        $salary_slip_insentif_product    = 0;
        $salary_slip_insentif_bonus      = 0;
        $product_fee                     = 0;
        $service_fee                     = 0;
        $num_work                        = 0;
        $insentif_row                    = $this->db_qry_data("SELECT COUNT(DISTINCT service_order.service_order_payregisternum) AS num_work,service_order.service_order_code,staff.staff_code,staff.staff_name,COUNT(service_order.service_order_id) AS unit_entry,SUM(service_orderdetails.service_orderdetails_total) AS amount_service,SUM(product_orderdetails.product_orderdetails_total) AS amount_product,(COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100 AS unit_entry_ratio,(SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100 AS amount_service_ratio,(SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100 AS amount_product_ratio,(CASE WHEN ((COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100) >=100 AND ((SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100) >=100 AND ((SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100) >=100 THEN 1 ELSE 0 END) AS target_bonus FROM service_order LEFT JOIN (SELECT * FROM staff) staff ON service_order.staff_code = staff.staff_code LEFT JOIN (SELECT service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total FROM service_orderdetails GROUP BY service_order_id) service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id LEFT JOIN (SELECT service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total FROM product_orderdetails GROUP BY service_order_id) product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id WHERE staff.staff_code ='" . $staff_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn' GROUP BY staff.staff_code ORDER BY staff.staff_code ASC");
        for ($i = 0; $i < count($insentif_row['select_data']); $i++) {
            //switch unit_entry_ratio
            $unit_entry_ratio = $insentif_row['select_data'][$i]['unit_entry_ratio'];
            switch ($unit_entry_ratio) {
                case $unit_entry_ratio >= $salary_target_data[0]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[1]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[0]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[1]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[1]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_unit_entry = 0;
            }
            //switch amount_service_ratio
            $amount_service_ratio = $insentif_row['select_data'][$i]['amount_service_ratio'];
            switch ($amount_service_ratio) {
                case $amount_service_ratio >= $salary_target_data2[0]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[1]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[0]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[1]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[1]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_service = 0;
            }
            //switch amount_product_ratio
            $amount_product_ratio = $insentif_row['select_data'][$i]['amount_product_ratio'];
            switch ($amount_product_ratio) {
                case $amount_product_ratio >= $salary_target_data3[0]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[1]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[0]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[1]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[1]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_product = 0;
            }
            //Bonus >100%
            $salary_slip_insentif_bonus = $insentif_row['select_data'][$i]['target_bonus'] * $company_row['company_insentif_bonus'];
            //product & service fee
            $get_service_fee = $this->get_service_fee($staff_code, $start_date, $end_date);
            $get_product_fee = $this->get_product_fee($staff_code, $start_date, $end_date);
            //$product_fee=(($insentif_row['select_data'][$i]['amount_product']*($company_row['product_fee_percent']/100))+$get_product_fee)*0.8;
            //$service_fee=(($insentif_row['select_data'][$i]['amount_service']*($company_row['service_fee_percent']/100))+$get_service_fee)*0.8;
            $product_fee = $get_product_fee;
            $service_fee = $get_service_fee;
            //daily insentif
            $salary_daily_target_arr    = $this->get_daily_insentif($staff_code, $start_date, $end_date);
            $salary_daily_target_amount = $salary_daily_target_arr['salary_daily_target_amount'];
            $salary_daily_target_ratio  = ($insentif_row['select_data'][$i]['unit_entry_ratio'] + $insentif_row['select_data'][$i]['amount_service_ratio'] + $insentif_row['select_data'][$i]['amount_product_ratio']) / 3;
            if ($salary_daily_target_ratio < 75) {
                $salary_daily_target_amount = $salary_daily_target_amount * ($salary_daily_target_ratio / 100);
            }
            $salary_daily_target_amount = number_format($salary_daily_target_amount, 2, '.', '');
            //num work
            //$num_work=$insentif_row['select_data'][$i]['num_work'];
            $num_work = $salary_daily_target_arr['num_work'];
        }
        $get_insentif_arr['salary_slip_insentif_unit_entry'] = $salary_slip_insentif_unit_entry;
        $get_insentif_arr['salary_slip_insentif_service']    = $salary_slip_insentif_service;
        $get_insentif_arr['salary_slip_insentif_product']    = $salary_slip_insentif_product;
        $get_insentif_arr['salary_slip_insentif_bonus']      = $salary_slip_insentif_bonus;
        $get_insentif_arr['product_fee']                     = $product_fee;
        $get_insentif_arr['service_fee']                     = $service_fee;
        $get_insentif_arr['salary_daily_target_amount']      = $salary_daily_target_amount;
        $get_insentif_arr['num_work']                        = $num_work;
        return $get_insentif_arr;
        //return $insentif_row['qry_str_sort'];
    }

    public function get_insentif($staff_code, $salary_slip_monthnum)
    {
        $start_date = intval($salary_slip_monthnum . "01");
        $end_date   = intval($salary_slip_monthnum . "31");
        //output
        $get_insentif_arr = [];
        //get salary_target ue
        $salary_target_select = $this->db_select("salary_target", "*", "salary_target_type='ue'", "", 0, 3);
        $salary_target_data   = $salary_target_select['select_data'];
        //get salary_target service
        $salary_target_select2 = $this->db_select("salary_target", "*", "salary_target_type='service'", "", 0, 3);
        $salary_target_data2   = $salary_target_select2['select_data'];
        //get salary_target product
        $salary_target_select3 = $this->db_select("salary_target", "*", "salary_target_type='product'", "", 0, 3);
        $salary_target_data3   = $salary_target_select3['select_data'];
        //company
        $company_row = $this->db_row("company", "*", "");
        //init
        $salary_slip_insentif_unit_entry = 0;
        $salary_slip_insentif_service    = 0;
        $salary_slip_insentif_product    = 0;
        $salary_slip_insentif_bonus      = 0;
        $product_fee                     = 0;
        $service_fee                     = 0;
        $num_work                        = 0;
        $insentif_row                    = $this->db_qry_data("SELECT COUNT(DISTINCT service_order.service_order_payregisternum) AS num_work,service_order.service_order_code,staff.staff_code,staff.staff_name,COUNT(service_order.service_order_id) AS unit_entry,SUM(service_orderdetails.service_orderdetails_total) AS amount_service,SUM(product_orderdetails.product_orderdetails_total) AS amount_product,(COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100 AS unit_entry_ratio,(SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100 AS amount_service_ratio,(SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100 AS amount_product_ratio,(CASE WHEN ((COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100) >=100 AND ((SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100) >=100 AND ((SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100) >=100 THEN 1 ELSE 0 END) AS target_bonus FROM service_order LEFT JOIN (SELECT * FROM staff) staff ON service_order.staff_code = staff.staff_code LEFT JOIN (SELECT service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total FROM service_orderdetails GROUP BY service_order_id) service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id LEFT JOIN (SELECT service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total FROM product_orderdetails GROUP BY service_order_id) product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id WHERE staff.staff_code ='" . $staff_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn' GROUP BY staff.staff_code ORDER BY staff.staff_code ASC");
        for ($i = 0; $i < count($insentif_row['select_data']); $i++) {
            //switch unit_entry_ratio
            $unit_entry_ratio = $insentif_row['select_data'][$i]['unit_entry_ratio'];
            switch ($unit_entry_ratio) {
                case $unit_entry_ratio >= $salary_target_data[0]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[1]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[0]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[1]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[1]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_unit_entry = 0;
            }
            //switch amount_service_ratio
            $amount_service_ratio = $insentif_row['select_data'][$i]['amount_service_ratio'];
            switch ($amount_service_ratio) {
                case $amount_service_ratio >= $salary_target_data2[0]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[1]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[0]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[1]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[1]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_service = 0;
            }
            //switch amount_product_ratio
            $amount_product_ratio = $insentif_row['select_data'][$i]['amount_product_ratio'];
            switch ($amount_product_ratio) {
                case $amount_product_ratio >= $salary_target_data3[0]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[1]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[0]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[1]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[1]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_product = 0;
            }
            //Bonus >100%
            $salary_slip_insentif_bonus = $insentif_row['select_data'][$i]['target_bonus'] * $company_row['company_insentif_bonus'];
            //product & service fee
            $get_service_fee = $this->get_service_fee($staff_code, $start_date, $end_date);
            $get_product_fee = $this->get_product_fee($staff_code, $start_date, $end_date);
            // $product_fee=(($insentif_row['select_data'][$i]['amount_product']*($company_row['product_fee_percent']/100))+$get_product_fee)*0.8;
            // $service_fee=(($insentif_row['select_data'][$i]['amount_service']*($company_row['service_fee_percent']/100))+$get_service_fee)*0.8;
            $product_fee = $get_product_fee;
            $service_fee = $get_service_fee;
            //daily insentif
            $salary_daily_target_arr    = $this->get_daily_insentif($staff_code, $start_date, $end_date);
            $salary_daily_target_amount = $salary_daily_target_arr['salary_daily_target_amount'];
            $salary_daily_target_ratio  = ($insentif_row['select_data'][$i]['unit_entry_ratio'] + $insentif_row['select_data'][$i]['amount_service_ratio'] + $insentif_row['select_data'][$i]['amount_product_ratio']) / 3;
            if ($salary_daily_target_ratio < 75) {
                $salary_daily_target_amount = $salary_daily_target_amount * ($salary_daily_target_ratio / 100);
            }
            $salary_daily_target_amount = number_format($salary_daily_target_amount, 2, '.', '');
            //num work
            //$num_work=$insentif_row['select_data'][$i]['num_work'];
            $num_work = $salary_daily_target_arr['num_work'];
        }
        $get_insentif_arr['salary_slip_insentif_unit_entry'] = $salary_slip_insentif_unit_entry;
        $get_insentif_arr['salary_slip_insentif_service']    = $salary_slip_insentif_service;
        $get_insentif_arr['salary_slip_insentif_product']    = $salary_slip_insentif_product;
        $get_insentif_arr['salary_slip_insentif_bonus']      = $salary_slip_insentif_bonus;
        $get_insentif_arr['product_fee']                     = $product_fee;
        $get_insentif_arr['service_fee']                     = $service_fee;
        $get_insentif_arr['salary_daily_target_amount']      = $salary_daily_target_amount;
        $get_insentif_arr['num_work']                        = $num_work;
        return $get_insentif_arr;
        //return $insentif_row['qry_str_sort'];
    }

//get service fee
    public function get_service_fee_nonpit($staff_code, $register_start, $register_end)
    {
        //get staff
        $contact_code    = $this->db_fldrow("staff", "contact_code", "staff_code='" . $staff_code . "'");
        $start_date      = $register_start;
        $end_date        = $register_end;
        $service_fee     = 0;
        $company_row     = $this->db_row("company", "*", "");
        $service_fee_arr = [];
        $service_fee_row = $this->db_qry_data("SELECT service_order.service_order_code as service_order_code,service_order.service_order_register,
staff.staff_name,service.service_code,
service_orderdetails.service_orderdetails_total AS amount_service,
service_orderdetails_total AS service_fee_amount
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
LEFT JOIN service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN service ON service_orderdetails.service_code = service.service_code
WHERE service_order.contact_code ='" . $contact_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
ORDER BY service_order.service_order_code ASC");
        for ($i = 0; $i < count($service_fee_row['select_data']); $i++) {
            // $absence_date=$this->date_stridtonum($service_fee_row['select_data'][$i]['service_order_register']);
            // if($this->tbldata_exist("absence","absence_id","absence_date='".$absence_date."' AND staff_code = '".$staff_code."' AND absence_status='work'")){
            // $service_fee_amount=$service_fee_row['select_data'][$i]['service_fee_amount'];
            // $service_amount=$service_fee_row['select_data'][$i]['amount_service'];
            // $absence_row=$this->db_row_join("absence,staff","count(absence.absence_id) as num_work","absence.absence_status='work' AND staff.position_code!='MK' AND absence.absence_date='".$absence_date."' AND absence.staff_code=staff.staff_code");
            // $num_staff_nonpit=$absence_row['num_work'];
            // $service_fee_arr[]['service_order_register']=$service_fee_row['select_data'][$i]['service_order_register'];
            // $service_fee_arr[]['service_fee_amount']=$service_fee_amount;
            // $service_fee_arr[]['service_amount']=$service_amount;
            // $service_fee_arr[]['num_staff_nonpit']=$num_staff_nonpit;
            // $service_fee_arr[]['service_fee']=((($service_amount*($company_row['service_fee_percent']/100))+$service_fee_amount)*0.2)/$num_staff_nonpit;
            // $service_fee+=$service_amount;
            //}
            $service_fee += $service_fee_row['select_data'][$i]['service_fee_amount'];
        }
        if ($service_fee >= $company_row['company_service_target']) {
            $service_fee_return = $service_fee * ($company_row['company_service_target_percent'] / 100);
        } else {
            $service_fee_return = $service_fee * ($company_row['company_service_def_percent'] / 100);
        }
        return $service_fee_return;
    }

//get product fee
    public function get_product_fee_nonpit($staff_code, $register_start, $register_end)
    {
        $contact_code    = $this->db_fldrow("staff", "contact_code", "staff_code='" . $staff_code . "'");
        $start_date      = $register_start;
        $end_date        = $register_end;
        $product_fee     = 0;
        $company_row     = $this->db_row("company", "*", "");
        $product_fee_arr = [];
        $product_fee_row = $this->db_qry_data("SELECT service_order.service_order_code,service_order.service_order_register,
staff.staff_name,product.product_code,
product_orderdetails.product_orderdetails_total AS amount_product,
(product_orderdetails_total) AS product_fee_amount
FROM service_order
LEFT JOIN staff ON service_order.staff_code = staff.staff_code
LEFT JOIN product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
LEFT JOIN product ON product_orderdetails.product_code = product.product_code
WHERE service_order.contact_code ='" . $contact_code . "' AND (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
ORDER BY service_order.service_order_code ASC");

$product_fee_non_service_row = $this->db_qry_data("SELECT product_order.product_order_code,product_order.product_order_register,product.product_code,
product_orderdetails.product_orderdetails_total AS amount_product,
(product_orderdetails_total) AS product_fee_amount
FROM product_order
LEFT JOIN product_orderdetails ON product_order.product_order_id = product_orderdetails.product_order_id
LEFT JOIN product ON product_orderdetails.product_code = product.product_code
WHERE product_order.contact_code ='" . $contact_code . "' AND (product_order.product_order_registernum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND product_order.product_order_status='pmn'
ORDER BY product_order.product_order_code ASC");
        for ($i = 0; $i < count($product_fee_row['select_data']); $i++) {            
            $product_fee += $product_fee_row['select_data'][$i]['product_fee_amount'];
        }
        for ($i = 0; $i < count($product_fee_non_service_row['select_data']); $i++) {            
            $product_fee += $product_fee_non_service_row['select_data'][$i]['product_fee_amount'];
        }
        if ($product_fee >= $company_row['company_part_target']) {
            $product_fee_return = $product_fee * ($company_row['company_part_target_percent'] / 100);
        } else {
            $product_fee_return = $product_fee * ($company_row['company_part_def_percent'] / 100);
        }
        return $product_fee_return;
    }

//get insentif
    public function get_daily_insentif_nonpit($staff_code, $salary_slip_monthnum)
    {
        $start_date                 = intval($salary_slip_monthnum . "01");
        $end_date                   = intval($salary_slip_monthnum . "31");
        $salary_daily_target_amount = 0;
        $get_insentif_arr           = [];
        $nonpit_arr                 = [];
        $num_work                   = 0;
        $daily_insentif_row         = $this->db_qry_data("SELECT service_order.service_order_register,COUNT(DISTINCT staff.staff_code) AS mechanic_num_all,
SUM(if(staff.staff_code = '" . $staff_code . "', 1, 0)) AS mechanic_if_selected,
SUM(service_orderdetails.service_orderdetails_total) AS amount_service,
SUM(product_orderdetails.product_orderdetails_total) AS amount_product
FROM service_order
LEFT JOIN (SELECT * FROM staff) staff ON service_order.staff_code = staff.staff_code
LEFT JOIN (SELECT service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total FROM service_orderdetails GROUP BY service_order_id) service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id
LEFT JOIN (SELECT service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total FROM product_orderdetails GROUP BY service_order_id) product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id
WHERE (service_order.service_order_registernum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'
GROUP BY service_order.service_order_registernum
ORDER BY service_order.service_order_registernum ASC");
        for ($i = 0; $i < count($daily_insentif_row['select_data']); $i++) {
            $absence_date = $this->date_stridtonum($daily_insentif_row['select_data'][$i]['service_order_register']);
            if ($this->tbldata_exist("absence", "absence_id", "absence_date='" . $absence_date . "' AND staff_code = '" . $staff_code . "' AND absence_status='work'")) {
                $num_work++;
                $daily_achievement = $daily_insentif_row['select_data'][$i]['amount_service'] + $daily_insentif_row['select_data'][$i]['amount_product'];
                //$get_insentif_arr[]['daily_achievement']=$daily_achievement;
                $db_select_daily_target   = $this->db_select("salary_daily_target", "*", "", "", 0, 0);
                $select_data_daily_target = $db_select_daily_target['select_data'];
                for ($i_dt = 0; $i_dt < $db_select_daily_target['select_num']; $i_dt++) {
                    $salary_daily_target_min = $select_data_daily_target[$i_dt]['salary_daily_target_min'];
                    $salary_daily_target_max = $select_data_daily_target[$i_dt]['salary_daily_target_max'];
                    if ($daily_achievement >= $salary_daily_target_min && $daily_achievement < $salary_daily_target_max) {
                        //$get_insentif_arr[]['salary_daily_target_amount']=$select_data_daily_target[$i_dt]['salary_daily_target_amount'];
                        $salary_daily_target_amount += $select_data_daily_target[$i_dt]['salary_daily_target_amount'];
                    }
                }
            }
        }
        $nonpit_arr['salary_daily_target_amount'] = $salary_daily_target_amount;
        $nonpit_arr['num_work']                   = $num_work;
        return $nonpit_arr;
        //return $get_insentif_arr;
    }

//get insentif
    public function get_comission_nonpit($staff_code, $start_date, $end_date)
    {
        $start_date = intval($start_date);
        $end_date   = intval($end_date);
        //output
        $get_insentif_arr = [];
        //get salary_target ue
        $salary_target_select = $this->db_select("salary_target", "*", "salary_target_type='ue'", "", 0, 3);
        $salary_target_data   = $salary_target_select['select_data'];
        //get salary_target service
        $salary_target_select2 = $this->db_select("salary_target", "*", "salary_target_type='service'", "", 0, 3);
        $salary_target_data2   = $salary_target_select2['select_data'];
        //get salary_target product
        $salary_target_select3 = $this->db_select("salary_target", "*", "salary_target_type='product'", "", 0, 3);
        $salary_target_data3   = $salary_target_select3['select_data'];
        //company
        $company_row = $this->db_row("company", "*", "");
        //init
        $salary_slip_insentif_unit_entry = 0;
        $salary_slip_insentif_service    = 0;
        $salary_slip_insentif_product    = 0;
        $salary_slip_insentif_bonus      = 0;
        $product_fee                     = 0;
        $service_fee                     = 0;
        $insentif_row                    = $this->db_qry_data("SELECT COUNT(DISTINCT service_order.service_order_payregisternum) AS num_work,COUNT(DISTINCT staff.staff_code) AS num_mechanic,service_order.service_order_code,staff.staff_code,staff.staff_name,COUNT(service_order.service_order_id) AS unit_entry,SUM(service_orderdetails.service_orderdetails_total) AS amount_service,SUM(product_orderdetails.product_orderdetails_total) AS amount_product,(COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100 AS unit_entry_ratio,(SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100 AS amount_service_ratio,(SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100 AS amount_product_ratio,(CASE WHEN ((COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100) >=100 AND ((SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100) >=100 AND ((SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100) >=100 THEN 1 ELSE 0 END) AS target_bonus FROM service_order LEFT JOIN (SELECT * FROM staff) staff ON service_order.staff_code = staff.staff_code LEFT JOIN (SELECT service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total FROM service_orderdetails GROUP BY service_order_id) service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id LEFT JOIN (SELECT service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total FROM product_orderdetails GROUP BY service_order_id) product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id WHERE (service_order.service_order_payregisternum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn' ORDER BY staff.staff_code ASC");
        for ($i = 0; $i < count($insentif_row['select_data']); $i++) {
            //switch unit_entry_ratio
            $unit_entry_ratio = $insentif_row['select_data'][$i]['unit_entry_ratio'] / $insentif_row['select_data'][$i]['num_mechanic'];
            switch ($unit_entry_ratio) {
                case $unit_entry_ratio >= $salary_target_data[0]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[1]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[0]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[1]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[1]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_unit_entry = 0;
            }
            //switch amount_service_ratio
            $amount_service_ratio = $insentif_row['select_data'][$i]['amount_service_ratio'] / $insentif_row['select_data'][$i]['num_mechanic'];
            switch ($amount_service_ratio) {
                case $amount_service_ratio >= $salary_target_data2[0]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[1]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[0]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[1]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[1]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_service = 0;
            }
            //switch amount_product_ratio
            $amount_product_ratio = $insentif_row['select_data'][$i]['amount_product_ratio'] / $insentif_row['select_data'][$i]['num_mechanic'];
            switch ($amount_product_ratio) {
                case $amount_product_ratio >= $salary_target_data3[0]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[1]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[0]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[1]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[1]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_product = 0;
            }
            //Bonus >100%
            $salary_slip_insentif_bonus = 0;
            //product & service fee 20%/total non pit
            $db_select_staff  = $this->db_select("staff", "staff_id", "staff_pit_status='nonpit'", "", 0, 0);
            $num_staff_nonpit = $db_select_staff['select_num'];
            $service_fee      = $this->get_service_fee_nonpit($staff_code, $start_date, $end_date);
            $product_fee      = $this->get_product_fee_nonpit($staff_code, $start_date, $end_date);
            //daily insentif
            $nonpit_arr                 = $this->get_daily_insentif_nonpit($staff_code, $salary_slip_monthnum);
            $salary_daily_target_amount = $nonpit_arr['salary_daily_target_amount'];
            $salary_daily_target_ratio  = ($unit_entry_ratio + $amount_service_ratio + $amount_product_ratio) / 3;
            if ($salary_daily_target_ratio < 75) {
                $salary_daily_target_amount = $salary_daily_target_amount * ($salary_daily_target_ratio / 100);
            }
            $salary_daily_target_amount = number_format($salary_daily_target_amount, 2, '.', '');
            //num work non pit
            $num_work = $nonpit_arr['num_work'];
        }
        $get_insentif_arr['salary_slip_insentif_unit_entry'] = $salary_slip_insentif_unit_entry;
        $get_insentif_arr['salary_slip_insentif_service']    = $salary_slip_insentif_service;
        $get_insentif_arr['salary_slip_insentif_product']    = $salary_slip_insentif_product;
        $get_insentif_arr['salary_slip_insentif_bonus']      = $salary_slip_insentif_bonus;
        $get_insentif_arr['product_fee']                     = $product_fee; //
        $get_insentif_arr['service_fee']                     = $service_fee; //
        $get_insentif_arr['salary_daily_target_amount']      = $salary_daily_target_amount;
        $get_insentif_arr['num_work']                        = $num_work;
        return $get_insentif_arr;
        //return $insentif_row['qry_str_sort'];
    }

    public function get_insentif_nonpit($staff_code, $salary_slip_monthnum)
    {
        $start_date = intval($salary_slip_monthnum . "01");
        $end_date   = intval($salary_slip_monthnum . "31");
        //output
        $get_insentif_arr = [];
        //get salary_target ue
        $salary_target_select = $this->db_select("salary_target", "*", "salary_target_type='ue'", "", 0, 3);
        $salary_target_data   = $salary_target_select['select_data'];
        //get salary_target service
        $salary_target_select2 = $this->db_select("salary_target", "*", "salary_target_type='service'", "", 0, 3);
        $salary_target_data2   = $salary_target_select2['select_data'];
        //get salary_target product
        $salary_target_select3 = $this->db_select("salary_target", "*", "salary_target_type='product'", "", 0, 3);
        $salary_target_data3   = $salary_target_select3['select_data'];
        //company
        $company_row = $this->db_row("company", "*", "");
        //init
        $salary_slip_insentif_unit_entry = 0;
        $salary_slip_insentif_service    = 0;
        $salary_slip_insentif_product    = 0;
        $salary_slip_insentif_bonus      = 0;
        $product_fee                     = 0;
        $service_fee                     = 0;
        $insentif_row                    = $this->db_qry_data("SELECT COUNT(DISTINCT service_order.service_order_registernum) AS num_work,COUNT(DISTINCT staff.staff_code) AS num_mechanic,service_order.service_order_code,staff.staff_code,staff.staff_name,COUNT(service_order.service_order_id) AS unit_entry,SUM(service_orderdetails.service_orderdetails_total) AS amount_service,SUM(product_orderdetails.product_orderdetails_total) AS amount_product,(COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100 AS unit_entry_ratio,(SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100 AS amount_service_ratio,(SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100 AS amount_product_ratio,(CASE WHEN ((COUNT(service_order.service_order_id)/" . $company_row['company_target_unit_entry'] . ")*100) >=100 AND ((SUM(service_orderdetails.service_orderdetails_total)/" . $company_row['company_target_service'] . ")*100) >=100 AND ((SUM(product_orderdetails.product_orderdetails_total)/" . $company_row['company_target_product'] . ")*100) >=100 THEN 1 ELSE 0 END) AS target_bonus FROM service_order LEFT JOIN (SELECT * FROM staff) staff ON service_order.staff_code = staff.staff_code LEFT JOIN (SELECT service_order_id,(SUM(service_orderdetails_total)) AS service_orderdetails_total FROM service_orderdetails GROUP BY service_order_id) service_orderdetails ON service_order.service_order_id = service_orderdetails.service_order_id LEFT JOIN (SELECT service_order_id,(SUM(product_orderdetails_total)) AS product_orderdetails_total FROM product_orderdetails GROUP BY service_order_id) product_orderdetails ON service_order.service_order_id = product_orderdetails.service_order_id WHERE (service_order.service_order_registernum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn' ORDER BY staff.staff_code ASC");
        for ($i = 0; $i < count($insentif_row['select_data']); $i++) {
            //switch unit_entry_ratio
            $unit_entry_ratio = $insentif_row['select_data'][$i]['unit_entry_ratio'] / $insentif_row['select_data'][$i]['num_mechanic'];
            switch ($unit_entry_ratio) {
                case $unit_entry_ratio >= $salary_target_data[0]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[1]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[0]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[1]['salary_target_percent'] && $unit_entry_ratio < $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[1]['salary_target_amount'];
                    break;
                case $unit_entry_ratio >= $salary_target_data[2]['salary_target_percent']:
                    $salary_slip_insentif_unit_entry = $salary_target_data[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_unit_entry = 0;
            }
            //switch amount_service_ratio
            $amount_service_ratio = $insentif_row['select_data'][$i]['amount_service_ratio'] / $insentif_row['select_data'][$i]['num_mechanic'];
            switch ($amount_service_ratio) {
                case $amount_service_ratio >= $salary_target_data2[0]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[1]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[0]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[1]['salary_target_percent'] && $amount_service_ratio < $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[1]['salary_target_amount'];
                    break;
                case $amount_service_ratio >= $salary_target_data2[2]['salary_target_percent']:
                    $salary_slip_insentif_service = $salary_target_data2[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_service = 0;
            }
            //switch amount_product_ratio
            $amount_product_ratio = $insentif_row['select_data'][$i]['amount_product_ratio'] / $insentif_row['select_data'][$i]['num_mechanic'];
            switch ($amount_product_ratio) {
                case $amount_product_ratio >= $salary_target_data3[0]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[1]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[0]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[1]['salary_target_percent'] && $amount_product_ratio < $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[1]['salary_target_amount'];
                    break;
                case $amount_product_ratio >= $salary_target_data3[2]['salary_target_percent']:
                    $salary_slip_insentif_product = $salary_target_data3[2]['salary_target_amount'];
                    break;
                default:
                    $salary_slip_insentif_product = 0;
            }
            //Bonus >100%
            $salary_slip_insentif_bonus = 0;
            //product & service fee 20%/total non pit
            $db_select_staff  = $this->db_select("staff", "staff_id", "staff_pit_status='nonpit'", "", 0, 0);
            $num_staff_nonpit = $db_select_staff['select_num'];
            $service_fee      = $this->get_service_fee_nonpit($staff_code, $start_date, $end_date);
            $product_fee      = $this->get_product_fee_nonpit($staff_code, $start_date, $end_date);
            //daily insentif
            $nonpit_arr                 = $this->get_daily_insentif_nonpit($staff_code, $salary_slip_monthnum);
            $salary_daily_target_amount = $nonpit_arr['salary_daily_target_amount'];
            $salary_daily_target_ratio  = ($unit_entry_ratio + $amount_service_ratio + $amount_product_ratio) / 3;
            if ($salary_daily_target_ratio < 75) {
                $salary_daily_target_amount = $salary_daily_target_amount * ($salary_daily_target_ratio / 100);
            }
            $salary_daily_target_amount = number_format($salary_daily_target_amount, 2, '.', '');
            //num work non pit
            $num_work = $nonpit_arr['num_work'];
        }
        $get_insentif_arr['salary_slip_insentif_unit_entry'] = $salary_slip_insentif_unit_entry;
        $get_insentif_arr['salary_slip_insentif_service']    = $salary_slip_insentif_service;
        $get_insentif_arr['salary_slip_insentif_product']    = $salary_slip_insentif_product;
        $get_insentif_arr['salary_slip_insentif_bonus']      = $salary_slip_insentif_bonus;
        $get_insentif_arr['product_fee']                     = $product_fee; //
        $get_insentif_arr['service_fee']                     = $service_fee; //
        $get_insentif_arr['salary_daily_target_amount']      = $salary_daily_target_amount;
        $get_insentif_arr['num_work']                        = $num_work;
        return $get_insentif_arr;
        //return $insentif_row['qry_str_sort'];
    }

//get insentif
    public function get_efective_work($salary_slip_monthnum)
    {
        $start_date   = intval($salary_slip_monthnum . "01");
        $end_date     = intval($salary_slip_monthnum . "31");
        $num_work     = 0;
        $insentif_row = $this->db_qry_data("SELECT COUNT(DISTINCT service_order.service_order_registernum) AS num_work FROM service_order WHERE (service_order.service_order_registernum BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND service_order.service_order_status='pmn'");
        for ($i = 0; $i < count($insentif_row['select_data']); $i++) {
            //num work non pit
            $num_work = $insentif_row['select_data'][0]['num_work'];
        }
        return $num_work;
    }

//code generator
    public function generator_code($str_code, $str_add_def, $substr_ind = 10, $str_add_ind = 5)
    {
        $str = substr($str_code, $substr_ind);

        if ($str == "") {
            $str = 1;
        } else {
            $str = ltrim($str, '0') + 1;
        }
        $str_add = $str_add_ind - strlen($str);
        $str2    = str_pad($str, (strlen($str) + $str_add), "0", STR_PAD_LEFT);
        return $str_add_def . $str2;
    }

//product order sale code generator
    public function generator_salary_slip_code($salary_slip_monthnum = "")
    {
        if ($salary_slip_monthnum == "") {
            $salary_slip_monthnum = intval(date("Y") . date("m"));
        }
        $db_select          = $this->db_select("salary_slip", "salary_slip_code", "salary_slip_monthnum='" . $salary_slip_monthnum . "'", "service_order_id DESC", 0, 1);
        $select_data        = $db_select['select_data'];
        $service_order_code = $select_data[0]['salary_slip_code'];
        $str_add_def        = "GJ." . date("Y") . date("m") . ".";
        return $this->generator_code($service_order_code, $str_add_def, 8);
    }
}
