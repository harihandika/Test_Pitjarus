<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');

	}
	public function index()
	{
		// Query
		$db = $this->db;
		$brand = $db->get('product_brand')->result();
		$area = $db->get('store_area')->result();
		// build Query
		$query_1 = $this->queryData(null,'01-01-1970',(date('Y-m-d')))->result_array();
		// Cleand Raw Data
		foreach ($brand as $a) {
          $dataBrand[($a->brand_name)] = [];
          foreach ($area as $s) {
             $getId = $this->findData($query_1,["brand" => $a->brand_name, "area_name" => $s->area_name]);
             $data[($s->area_name)] = $query_1[$getId[0]]['compliance'];
             
           } 
           array_push($dataBrand[($a->brand_name)], $data);
        };

        foreach ($dataBrand as $key => $value) {
          foreach ($value[0] as $key_1 => $value_1) {
              $sum[$key_1][] = $value_1;
          };
        };

        foreach ($sum as $key => $value) {
          $data_x[$key] = array_sum($value);
        };

        // Result For Table


		$data = [
			"area" => $area,
			"brand" => $brand,
			"dataResult" => $query_1,
			"rowCount" => $db->get('report_product')->num_rows(),
			"data_x" => $data_x,


		];
		$this->load->view('index.php', $data);


	}

	public function view_data()
	{
		$db = $this->db;
		$inputData = $this->input->post();

		$query_2 = $this->queryData($inputData['area'],$inputData['dateFrom'],$inputData['dateTo'])->result_array();

		$data = [
			"dataResult" => $query_2,
			"rowCount" => $db->get('report_product')->num_rows(),
		];

		$this->load->view('view_data.php', $data);

	}

	public function queryData($area,$dateFromInput, $dateToInput)
	{
		$dateFrom = date('Y-m-d', strtotime($dateFromInput));
		$dateTo = date('Y-m-d', strtotime($dateToInput));
		$db = $this->db;
		$db->select('product_brand.brand_name AS brand, store_area.area_name AS area_name, report_product.compliance');
		$db->select_sum('report_product.compliance');
		$db->from('report_product');
		$db->join('store', 'report_product.store_id = store.store_id');
		$db->join('store_area', 'store.area_id = store_area.area_id');
		$db->join('product', 'report_product.product_id = product.product_id');
		$db->join('product_brand', 'product.brand_id = product_brand.brand_id');
		if ($area == null) {
			$db->where('tanggal >=', $dateFrom);
			$db->where('tanggal <=', $dateTo);
		}else{
			$db->where(['area_name' => $area]);
			$db->where('tanggal >=', $dateFrom);
			$db->where('tanggal <=', $dateTo);
		};
		$db->group_by(['brand', 'area_name']);
		$db->order_by('brand', 'DESC');
		

		return $db->get();

	}

	 function findData($array, $search)
        {

          // Create the result array
          $result = array();

          // Iterate over each array element
          foreach ($array as $key => $value)
          {

            // Iterate over each search condition
            foreach ($search as $k => $v)
            {

              // If the array element does not meet the search condition then continue to the next element
              if (!isset($value[$k]) || $value[$k] != $v)
              {
                continue 2;
              }

            }

            // Add the array element's key to the result array
            $result[] = $key;

          }

          // Return the result array
          return $result;

      }
}
