<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Model {

    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

	}

	public function fiftyvalues()
	{
		$result_set = $this->db->get('fiftyvalues');
		$data = $result_set->result_array();

		$i = 0;
		while($i < 50){
			$data[$i]['hash'] = hash('sha256',$data[$i]['value']);
			$i++;
		}

		return $data;
	}

	public function sort(){



		function mergesort($data) {

			if(count($data)>1) {


				$data_middle = round(count($data)/2, 0, PHP_ROUND_HALF_DOWN);

				$data_part1 = mergesort(array_slice($data, 0, $data_middle));
				$data_part2 = mergesort(array_slice($data, $data_middle, count($data)));

				$counter1 = $counter2 = 0;

				for ($i=0; $i<count($data); $i++) {

					if($counter1 == count($data_part1)) {
						$data[$i] = $data_part2[$counter2];
						++$counter2;
					} elseif (($counter2 == count($data_part2)) or ($data_part1[$counter1]['name'] < $data_part2[$counter2]['name'])) {
						$data[$i] = $data_part1[$counter1];
						++$counter1;
					} else {
						$data[$i] = $data_part2[$counter2];
						++$counter2;
					}
				}
			}

			return $data;
		}


		$query = $this->db->query('SELECT id, name FROM names');
		$data = $query->result_array();


		return mergesort($data);
	}

	public function graph(){
		$result_set = $this->db->get('names');
		$data = $result_set->result_array();

		$graph['nodes'] = array();
		$graph['edges'] = array();
		/*
		array_push($graph['nodes'],array("id"=>"2","x"=>3,"y"=>6,"size"=>1));
		array_push($graph['nodes'],array("id"=>"3","x"=>5,"y"=>2,"size"=>1));
		array_push($graph['nodes'],array("id"=>"4","x"=>6,"y"=>4,"size"=>1));

		array_push($graph['edges'],array("id"=>"1","source"=>"2","target"=>"3"));
		array_push($graph['edges'],array("id"=>"2","source"=>"3","target"=>"4"));
		array_push($graph['edges'],array("id"=>"3","source"=>"4","target"=>"2"));
*/
		$i = 0;
		foreach($data as $d){
			array_push($graph['nodes'],array("id"=>$d['id'],"x"=>rand(1,100),"y"=>rand(1,100),"size"=>1));
			$edges = explode(",",$d['friends']);
			foreach($edges as $edge){
				array_push($graph['edges'],array("id"=>$i,"source"=>$d['id'],"target"=>$edge));
				$i++;
			}

		}

		return $graph;
	}


	public function primes(){
		$number = 2;
		$finish = 500;
		$range = range(2,500);
		$primes = array_combine($range,$range);


		while ($number*$number < $finish) {
			for ($i = $number; $i <= $finish; $i += $number) {
			if ($i == $number) {
				continue;
			}
			unset($primes[$i]);
			}
			$number = next($primes);
		}


		return $primes;
	}

	public function insert(){
		$object = array('customer'=>"Bob Jones",
		'item'=>'putter',
		'price'=>500);

		$this->db->insert('transactions', $object);
		return true;
	}


	public function checkForHash($hash){
		$pairs = array(
			array('string1'=>'ethereal','string2'=>'front'),
			array('string1'=>'ask','string2'=>'release'),
			array('string1'=>'bucket','string2'=>'unique'),
			array('string1'=>'plug','string2'=>'average'),
			array('string1'=>'trade','string2'=>'weather'),
			array('string1'=>'card','string2'=>'wide'),
			array('string1'=>'numberless','string2'=>'copper'),
			array('string1'=>'fruit','string2'=>'example'),
			array('string1'=>'slap','string2'=>'pause'),
			array('string1'=>'jittery','string2'=>'confused'));

		foreach($pairs as $pair){
			if(hash('sha256',$pair['string1'].$pair['string2'])==$hash){
				return true;
			}
		}

		return false;
	}

	public function minmax(){
		$data['values'] = array();

		$i = 0;
		while($i < 20){
			array_push($data['values'],rand());
			$i++;
		}
		$data['min'] = $data['values'][0];
		$data['max'] = $data['values'][0];

		foreach($data['values'] as $v){
			if($v < $data['min']){
				$data['min'] = $v;
			}
			if($v > $data['max']){
				$data['max'] = $v;
			}
		}

		return $data;

	}


	public function generateFriends(){

		$result_set = $this->db->get('names');
		$data = $result_set->result_array();

		$f1 = 0;
		$f2 = 0;
		$f3 = 0;
		$temp = array();

		foreach($data as $n){
			$f1 = rand(1,100);
			if($f1 == $n['id']){
				$f1 += 1;
			}
			array_push($temp,$f1);

			$f2 = rand(1,100);
			if($f2 == $f1){
				$f2 += 1;
			}
			if($f2 == $n['id']){
				$f2 += 1;
			}
			array_push($temp,$f2);

			$f3 = rand(1,99);
			if($f3 == $f2||$f3 == $f1){
				$f3 += 1;
			}
			if($f3 == $n['id']){
				$f3 += 1;
			}
			array_push($temp,$f3);

			$d['friends'] = implode(',',$temp);
			$this->db->where('id', $n['id']);
			$this->db->update('names', $d);
			$temp = array();
		}

	}


}
