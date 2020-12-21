<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Dashboard extends CI_Controller {
     function __construct(){
         parent::__construct();
		 
		 $this->load->helper('date'); 
		 $this->load->helper(array('url','form'));
		 $this->load->model('m_account'); 
		 $this->load->library('session');

     }
 
     //Load Halaman dashboard
	public function index() {
		$this->data["rules"] = $this->m_account->collectRules();
		$this->data["dataBobot"] = $this->m_account->collectBobot();
		
		$this->load->view('welcome_message.php', $this->data);
		
	}
	public function pembobotan(){
		$this->data['posts'] = $this->m_account->collectBobot();
		$this->load->view('viewBobot.php', $this->data);
	}
	public function editData($data){
		$dataBaru['dataBobot'] = $this->m_account->collectDataBobot($data);	
		$this->load->view('editBobot',$dataBaru);
	}
	public function editBobot()
	{
		$data["class"] = $this->input->post('class');
		$data["bobot"] = $this->input->post('bobot');
		$this->m_account->editBobot($data);
		$this->data['posts'] = $this->m_account->collectBobot();
		$this->load->view('viewBobot.php', $this->data);
	}
	public function tambahGejala(){
		$this->data['posts'] = $this->m_account->collection_gejala(); 
		$this->load->view('viewTambahGejala', $this->data);
		
	}
	public function postTambahGejala(){
		$data["gejala"] = $this->input->post('gejala');
		$this->m_account->registerGejala($data);
		$this->data['posts'] = $this->m_account->collection_gejala(); 
		$this->load->view('viewTambahGejala', $this->data);
		
	}
	public function deleteGejala($data)
	{
		$this->m_account->deleteGejala($data);
		$this->data['posts'] = $this->m_account->collection_gejala(); 
		$this->load->view('viewTambahGejala', $this->data);

	}
	//ini fuzzynya
	public function fuzzySystem()
	{
		$counter=0;
		$rules = $this->m_account->collectRules();
		$penyakit = ["Katarak", "Gloukoma", "Kelainan Refraksi"];
		$nilaiPenyakit = [0,0,0];
		$newBobot = [];
		foreach($rules as $rule)
		{
			$currentRules = (string)$rule->id;
			$currentRules = str_replace(' ', '', $currentRules);
			$data[$counter] = $this->input->post($currentRules);
			//echo $data[$counter];
			$counter++;
		}
		
		//defuzzy katarak (iya 0-3, tidak 7-10) 
		//ini variable sama proses fuzzyfikasi
		$kondisiGj1 = [0,0,0,0];$kondisiGj2 = [0,0,0,0];
		$valKondisiGj1 = [0,0,0,0];$valKondisiGj2 = [0,0,0,0];
		$kondisiGj3 = [0,0,0,0];$kondisiGj4 = [0,0,0,0];
		$valKondisiGj3 = [0,0,0,0];$valKondisiGj4 = [0,0,0,0];
		$kondisiGj5 = [0,0,0,0];$kondisiGj6 = [0,0,0,0]; $kondisiGj7 = [0,0,0,0];
		$valKondisiGj5 = [0,0,0,0]; $valKondisiGj6 = [0,0,0,0]; $valKondisiGj7 = [0,0,0,0];
		$kondisiGj8 = [0,0,0,0];$kondisiGj9 = [0,0,0,0];
		$valKondisiGj8 = [0,0,0,0];$valKondisiGj9 = [0,0,0,0];
		$dkKondisiKatarak = []; $dkKondisiGlukoma = []; $dkKondisiRefraksi = [];
		
		//gejala 1 proses fuzzyfikasi, 3=batasan minimal, 7 batasan maksimal
		//langkah 1. dicari nilai fuzzyfikasi dari awal inputan 1-10 dijadikan 0-1
		if($data[0]<3){$kondisiGj1[0] = 1; $valKondisiGj1[0] = 1; }
		else if($data[0]>=3 && $data[0]<7)
		{
			$kondisiGj1[0] = $kondisiGj1[1] = 1; 
			$valKondisiGj1[0] = (7 - $data[0]) / 4;
			$valKondisiGj1[1] = ($data[0] - 3) / 4;
		}
		else{ $kondisiGj1[2] = 1; $valKondisiGj1[2] = 1; }
		
		//gejala 2 fuzzyfikasi
		if($data[1]<3){$kondisiGj2[0] = 1; $valKondisiGj2[0] = 1; }
		else if($data[1]>=3 && $data[1]<7)
		{
			$kondisiGj2[0] = $kondisiGj2[1] = 1; 
			$valKondisiGj2[0] = (7 - $data[1]) / 4;
			$valKondisiGj2[1] = ($data[1] - 3) / 4;
		}
		else{ $kondisiGj2[2] = 1; $valKondisiGj2[2] = 1; }
		
		//gejala 3
		if($data[2]<3){$kondisiGj3[0] = 1; $valKondisiGj3[0] = 1; }
		else if($data[2]>=3 && $data[2]<7)
		{
			$kondisiGj3[0] = $kondisiGj3[1] = 1; 
			$valKondisiGj3[0] = (7 - $data[2]) / 4;
			$valKondisiGj3[1] = ($data[2] - 3) / 4;
		}
		else{ $kondisiGj3[2] = 1; $valKondisiGj3[2] = 1; }
		
		//gejala 4
		if($data[3]<3){$kondisiGj4[0] = 1; $valKondisiGj4[0] = 1; }
		else if($data[3]>=3 && $data[3]<7)
		{
			$kondisiGj4[0] = $kondisiGj4[1] = 1; 
			$valKondisiGj4[0] = (7 - $data[3]) / 4;
			$valKondisiGj4[1] = ($data[3] - 3) / 4;
		}
		else{ $kondisiGj4[2] = 1; $valKondisiGj4[2] = 1; }
		
		$counterMin=0;
		//rule base (aturan yg digunakan)
		//proses 2. aturan yg akan digunakan
		for($a=0; $a<3; $a++)
		{
			for($b=0; $b<3; $b++)
			{
				for($c=0; $c<3; $c++)
				{
					for($d=0; $d<3; $d++)
					{
						if($kondisiGj1[$a] == 1 && $kondisiGj2[$b] == 1 && $kondisiGj3[$c] == 1 && $kondisiGj4[$d] == 1)
						{
							$minData = min($valKondisiGj1[$a], $valKondisiGj2[$b],$valKondisiGj3[$c], $valKondisiGj4[$d]);
							//dari aturan yg terbaca hasil input 1-10 dicari nilai minimumnya(sesuai metode yg dipakai)
							$dkKondisiKatarak[$counterMin] =  $minData;
						
						}
						else
						{
							$dkKondisiKatarak[$counterMin] = 0;
						}
						
						/*
						echo $counterMin; echo "=>";
						if($a == 0){echo "g";} if($a==1){echo "-";} if($a==2){echo "y";}
						if($b == 0){echo "g";} if($b==1){echo "-";} if($b==2){echo "y";}
						if($c == 0){echo "g";} if($c==1){echo "-";} if($c==2){echo "y";}
						if($d == 0){echo "g";} if($d==1){echo "-";} if($d==2){echo "y";}
						echo "\n";
						*/
						$counterMin++;	
					}
				}
				
			}
		}
		/*
		0=>gggg 1=>ggg- 2=>gggy 3=>gg-g 4=>gg-- 5=>gg-y 6=>ggyg 7=>ggy- 8=>ggyy 9=>g-gg 10=>g-g- 11=>g-gy 12=>g--g 13=>g--- 14=>g--y 15=>g-yg 
		16=>g-y- 17=>g-yy 18=>gygg 19=>gyg- 20=>gygy 21=>gy-g 22=>gy-- 23=>gy-y 24=>gyyg 25=>gyy- 26=>gyyy 27=>-ggg 28=>-gg- 29=>-ggy 30=>-g-g 
		31=>-g-- 32=>-g-y 33=>-gyg 34=>-gy- 35=>-gyy 36=>--gg 37=>--g- 38=>--gy 39=>---g 40=>---- 41=>---y 42=>--yg 43=>--y- 44=>--yy 45=>-ygg 
		46=>-yg- 47=>-ygy 48=>-y-g 49=>-y-- 50=>-y-y 51=>-yyg 52=>-yy- 53=>-yyy 54=>yggg 55=>ygg- 56=>yggy 57=>yg-g 58=>yg-- 59=>yg-y 60=>ygyg 
		61=>ygy- 62=>ygyy 63=>y-gg 64=>y-g- 65=>y-gy 66=>y--g 67=>y--- 68=>y--y 69=>y-yg 70=>y-y- 71=>y-yy 72=>yygg 73=>yyg- 74=>yygy 75=>yy-g 
		76=>yy-- 77=>yy-y 78=>yyyg 79=>yyy- 80=>yyyy
		*/
		//ini aturanya derajat kondisi katarak nomer berapa yg masuk ke kategori tidak katarak dan katarak
		$tidakKatarak = max($dkKondisiKatarak[0],$dkKondisiKatarak[1],$dkKondisiKatarak[2],$dkKondisiKatarak[3],$dkKondisiKatarak[4],
							$dkKondisiKatarak[5],$dkKondisiKatarak[6],$dkKondisiKatarak[7],$dkKondisiKatarak[8],$dkKondisiKatarak[9],
							$dkKondisiKatarak[10],$dkKondisiKatarak[11],$dkKondisiKatarak[12],$dkKondisiKatarak[15],$dkKondisiKatarak[18],
							$dkKondisiKatarak[19],$dkKondisiKatarak[20],$dkKondisiKatarak[21],$dkKondisiKatarak[24],$dkKondisiKatarak[27], 
							$dkKondisiKatarak[28],$dkKondisiKatarak[29],$dkKondisiKatarak[30],$dkKondisiKatarak[33],$dkKondisiKatarak[36],
							$dkKondisiKatarak[45],$dkKondisiKatarak[54],$dkKondisiKatarak[55],$dkKondisiKatarak[56],$dkKondisiKatarak[57],
							$dkKondisiKatarak[60],$dkKondisiKatarak[63],$dkKondisiKatarak[72]);
		$indikasiKatarak = max($dkKondisiKatarak[13],$dkKondisiKatarak[14],$dkKondisiKatarak[16],$dkKondisiKatarak[17],$dkKondisiKatarak[22],
							$dkKondisiKatarak[23],$dkKondisiKatarak[25],$dkKondisiKatarak[26],$dkKondisiKatarak[31],$dkKondisiKatarak[32],
							$dkKondisiKatarak[34],$dkKondisiKatarak[35],$dkKondisiKatarak[37],$dkKondisiKatarak[38],$dkKondisiKatarak[39],
							$dkKondisiKatarak[40],$dkKondisiKatarak[41],$dkKondisiKatarak[42],$dkKondisiKatarak[43],$dkKondisiKatarak[44],
							$dkKondisiKatarak[46],$dkKondisiKatarak[47],$dkKondisiKatarak[48],$dkKondisiKatarak[49],$dkKondisiKatarak[50],
							$dkKondisiKatarak[51],$dkKondisiKatarak[51],$dkKondisiKatarak[52],$dkKondisiKatarak[53],$dkKondisiKatarak[58],
							$dkKondisiKatarak[59],$dkKondisiKatarak[61],$dkKondisiKatarak[62],$dkKondisiKatarak[64],$dkKondisiKatarak[65],
							$dkKondisiKatarak[66],$dkKondisiKatarak[67],$dkKondisiKatarak[68],$dkKondisiKatarak[69],$dkKondisiKatarak[70],
							$dkKondisiKatarak[71],$dkKondisiKatarak[73],$dkKondisiKatarak[74],$dkKondisiKatarak[75],$dkKondisiKatarak[76],
							$dkKondisiKatarak[77],$dkKondisiKatarak[78],$dkKondisiKatarak[79],$dkKondisiKatarak[80]);
		
		//ambil bobot iya dan tidak di database
		$getBobotTrue = $this->m_account->getBobot("iya");
		$getBobotFalse = $this->m_account->getBobot("tidak");
		$valTrue=0; $valFalse=0;
		foreach($getBobotTrue as $true)
		{
			$valTrue = $true->bobot;
		}
		foreach($getBobotFalse as $false)
		{
			$valFalse = $false->bobot;
		}
		//proses ke 3. yaitu defuzzyfikasi, hasil dari rule base (0-1) di ubah ke nilai percentase
		//echo $valTrue; echo "*"; echo $indikasiKatarak; echo " "; echo $valFalse; echo "*";echo $tidakKatarak; echo " ";
		$resultDefuzzyfikasiKatarak = (($valTrue * $indikasiKatarak) + ($valFalse * $tidakKatarak)) / ($valFalse + $valTrue);
		
		$resultKatarak;
		//echo $resultDefuzzyfikasiKatarak; echo "=>";
		//ini yg di pakai untuk menentukan kalau di atas 0.5(50%) maka dinyatakan kena penyakit katarak
		if($resultDefuzzyfikasiKatarak > 0.50){$resultKatarak="Katarak";}
		else{$resultKatarak = "Tidak Katarak";}
		
		
		//fuzzyfikasi glukoma, yg ini untuk mencari nilai glukoma,
		//gejala 5
		if($data[4]<3){$kondisiGj5[0] = 1; $valKondisiGj5[0] = 1; }
		else if($data[4]>=3 && $data[4]<7)
		{
			$kondisiGj5[0] = $kondisiGj5[1] = 1; 
			$valKondisiGj5[0] = (7 - $data[4]) / 4;
			$valKondisiGj5[1] = ($data[4] - 3) / 4;
		}
		else{ $kondisiGj5[2] = 1; $valKondisiGj5[2] = 1; }
		
		//gejala 6
		if($data[5]<3){$kondisiGj6[0] = 1; $valKondisiGj6[0] = 1; }
		else if($data[5]>=3 && $data[5]<7)
		{
			$kondisiGj6[0] = $kondisiGj6[1] = 1; 
			$valKondisiGj6[0] = (7 - $data[5]) / 4;
			$valKondisiGj6[1] = ($data[5] - 3) / 4;
		}
		else{ $kondisiGj6[2] = 1; $valKondisiGj6[2] = 1; }
		
		//gejala 7
		if($data[6]<3){$kondisiGj7[0] = 1; $valKondisiGj7[0] = 1; }
		else if($data[6]>=3 && $data[6]<7)
		{
			$kondisiGj7[0] = $kondisiGj7[1] = 1; 
			$valKondisiGj7[0] = (7 - $data[6]) / 4;
			$valKondisiGj7[1] = ($data[6] - 3) / 4;
		}
		else{ $kondisiGj7[2] = 1; $valKondisiGj7[2] = 1; }
		
		
		
		//rule base
		$counterMin=0;
		//rule base
		for($a=0; $a<3; $a++)
		{
			for($b=0; $b<3; $b++)
			{
				for($c=0; $c<3; $c++)
				{					
					if($kondisiGj5[$a] == 1 && $kondisiGj6[$b] == 1 && $kondisiGj7[$c] == 1)
					{
						$minData = min($valKondisiGj5[$a], $valKondisiGj6[$b],$valKondisiGj7[$c]);
						$dkKondisiGlukoma[$counterMin] =  $minData;
					
					}
					else
					{
						$dkKondisiGlukoma[$counterMin] = 0;
					}
					//echo $dkKondisiGlukoma[$counterMin];
					/*
					echo $counterMin; echo "=>";
					if($a == 0){echo "g";} if($a==1){echo "-";} if($a==2){echo "y";}
					if($b == 0){echo "g";} if($b==1){echo "-";} if($b==2){echo "y";}
					if($c == 0){echo "g";} if($c==1){echo "-";} if($c==2){echo "y";}
					echo "\n";
					*/
					$counterMin++;		
				}
				
			}
		}
		/*
		0=>ggg 1=>gg- 2=>ggy 3=>g-g 4=>g-- 5=>g-y 6=>gyg 7=>gy- 8=>gyy 9=>-gg 10=>-g- 11=>-gy 12=>--g 13=>--- 14=>--y 15=>-yg 16=>-y- 
		17=>-yy 18=>ygg 19=>yg- 20=>ygy 21=>y-g 22=>y-- 23=>y-y 24=>yyg 25=>yy- 26=>yyy
		*/
		$tidakGlukoma = max($dkKondisiGlukoma[0],$dkKondisiGlukoma[1],$dkKondisiGlukoma[2],$dkKondisiGlukoma[3],$dkKondisiGlukoma[6],
							$dkKondisiGlukoma[9],$dkKondisiGlukoma[18]);
		$indikasiGlukoma = max($dkKondisiGlukoma[4],$dkKondisiGlukoma[5],$dkKondisiGlukoma[7],$dkKondisiGlukoma[8],$dkKondisiGlukoma[10],
							$dkKondisiGlukoma[11],$dkKondisiGlukoma[12],$dkKondisiGlukoma[13],$dkKondisiGlukoma[14],$dkKondisiGlukoma[15],
							$dkKondisiGlukoma[16],$dkKondisiGlukoma[17],$dkKondisiGlukoma[19],$dkKondisiGlukoma[20],$dkKondisiGlukoma[21],
							$dkKondisiGlukoma[22],$dkKondisiGlukoma[23],$dkKondisiGlukoma[24],$dkKondisiGlukoma[25],$dkKondisiGlukoma[26]);
		//defuzzifikasi glukoma
		$getBobotTrue = $this->m_account->getBobot("iya");
		$getBobotFalse = $this->m_account->getBobot("tidak");
		$valTrue=0; $valFalse=0;
		foreach($getBobotTrue as $true)
		{
			$valTrue = $true->bobot;
		}
		foreach($getBobotFalse as $false)
		{
			$valFalse = $false->bobot;
		}
		$resultDefuzzyfikasiGlukoma = (($valTrue * $indikasiGlukoma) + ($valFalse * $tidakGlukoma)) / ($valFalse + $valTrue);
		
		$resultGlukoma;
		//echo $resultDefuzzyfikasiGlukoma; echo "=>";
		if($resultDefuzzyfikasiGlukoma > 0.50){$resultGlukoma = "Glukoma";}
		else{$resultGlukoma = "Tidak Glukoma";}
		
		
		//fuzzyfikasi kelainan refraksi
		//gejala 8
		if($data[7]<3){$kondisiGj8[0] = 1; $valKondisiGj8[0] = 1; }
		else if($data[7]>=3 && $data[7]<7)
		{
			$kondisiGj8[0] = $kondisiGj8[1] = 1; 
			$valKondisiGj8[0] = (7 - $data[7]) / 4;
			$valKondisiGj8[1] = ($data[7] - 3) / 4;
		}
		else{ $kondisiGj7[2] = 1; $valKondisiGj8[2] = 1; }
		
		//gejala 9
		if($data[8]<3){$kondisiGj9[0] = 1; $valKondisiGj9[0] = 1; }
		else if($data[8]>=3 && $data[8]<7)
		{
			$kondisiGj9[0] = $kondisiGj9[1] = 1; 
			$valKondisiGj9[0] = (7 - $data[8]) / 4;
			$valKondisiGj9[1] = ($data[8] - 3) / 4;
		}
		else{ $kondisiGj7[2] = 1; $valKondisiGj9[2] = 1; }
		
		
		//rulebase refraksi
		$counterMin=0;
		//rule base
		for($a=0; $a<3; $a++)
		{
			for($b=0; $b<3; $b++)
			{
				for($c=0; $c<3; $c++)
				{
					for($d=0; $d<3; $d++)
					{
						if($kondisiGj5[$a] == 1 && $kondisiGj7[$b] == 1 && $kondisiGj8[$c] == 1 && $kondisiGj9[$d] == 1)
						{
							$minData = min($valKondisiGj5[$a], $valKondisiGj7[$b],$valKondisiGj8[$c], $valKondisiGj9[$d]);
							$dkKondisiRefraksi[$counterMin] =  $minData;
						
						}
						else
						{
							$dkKondisiRefraksi[$counterMin] = 0;
						}
						$counterMin++;	
					}
				}
				
			}
		}
		$tidakRefraksi = max($dkKondisiRefraksi[0],$dkKondisiRefraksi[1],$dkKondisiRefraksi[2],$dkKondisiRefraksi[3],$dkKondisiRefraksi[4],
							$dkKondisiRefraksi[5],$dkKondisiRefraksi[6],$dkKondisiRefraksi[7],$dkKondisiRefraksi[8],$dkKondisiRefraksi[9],
							$dkKondisiRefraksi[10],$dkKondisiRefraksi[11],$dkKondisiRefraksi[12],$dkKondisiRefraksi[15],$dkKondisiRefraksi[18],
							$dkKondisiRefraksi[19],$dkKondisiRefraksi[20],$dkKondisiRefraksi[21],$dkKondisiRefraksi[24],$dkKondisiRefraksi[27], 
							$dkKondisiRefraksi[28],$dkKondisiRefraksi[29],$dkKondisiRefraksi[30],$dkKondisiRefraksi[33],$dkKondisiRefraksi[36],
							$dkKondisiRefraksi[45],$dkKondisiRefraksi[54],$dkKondisiRefraksi[55],$dkKondisiRefraksi[56],$dkKondisiRefraksi[57],
							$dkKondisiRefraksi[60],$dkKondisiRefraksi[63],$dkKondisiRefraksi[72]);
		$indikasiRefraksi = max($dkKondisiRefraksi[13],$dkKondisiRefraksi[14],$dkKondisiRefraksi[16],$dkKondisiRefraksi[17],$dkKondisiRefraksi[22],
							$dkKondisiRefraksi[23],$dkKondisiRefraksi[25],$dkKondisiRefraksi[26],$dkKondisiRefraksi[31],$dkKondisiRefraksi[32],
							$dkKondisiRefraksi[34],$dkKondisiRefraksi[35],$dkKondisiRefraksi[37],$dkKondisiRefraksi[38],$dkKondisiRefraksi[39],
							$dkKondisiRefraksi[40],$dkKondisiRefraksi[41],$dkKondisiRefraksi[42],$dkKondisiRefraksi[43],$dkKondisiRefraksi[44],
							$dkKondisiRefraksi[46],$dkKondisiRefraksi[47],$dkKondisiRefraksi[48],$dkKondisiRefraksi[49],$dkKondisiRefraksi[50],
							$dkKondisiRefraksi[51],$dkKondisiRefraksi[51],$dkKondisiRefraksi[52],$dkKondisiRefraksi[53],$dkKondisiRefraksi[58],
							$dkKondisiRefraksi[59],$dkKondisiRefraksi[61],$dkKondisiRefraksi[62],$dkKondisiRefraksi[64],$dkKondisiRefraksi[65],
							$dkKondisiRefraksi[66],$dkKondisiRefraksi[67],$dkKondisiRefraksi[68],$dkKondisiRefraksi[69],$dkKondisiRefraksi[70],
							$dkKondisiRefraksi[71],$dkKondisiRefraksi[73],$dkKondisiRefraksi[74],$dkKondisiRefraksi[75],$dkKondisiRefraksi[76],
							$dkKondisiRefraksi[77],$dkKondisiRefraksi[78],$dkKondisiRefraksi[79],$dkKondisiRefraksi[80]);
		
		//defuzzyfikasi refraksi
		$getBobotTrue = $this->m_account->getBobot("iya");
		$getBobotFalse = $this->m_account->getBobot("tidak");
		$valTrue=0; $valFalse=0;
		foreach($getBobotTrue as $true)
		{
			$valTrue = $true->bobot;
		}
		foreach($getBobotFalse as $false)
		{
			$valFalse = $false->bobot;
		}
		$resultDefuzzyfikasiRefraksi = (($valTrue * $indikasiRefraksi) + ($valFalse * $tidakRefraksi)) / ($valFalse + $valTrue);
		
		//echo $resultDefuzzyfikasiRefraksi; echo "=>";
		$resultRefraksi;
		if($resultDefuzzyfikasiRefraksi > 0.50){$resultRefraksi = "Kelainan Refraksi";}
		else{$resultRefraksi="Tidak Kelainan Refraksi";}
		
		$getSolusiKatarak = $this->m_account->collectSolusiBy("Katarak");
		$getSolusiGlukoma = $this->m_account->collectSolusiBy("Glukoma");
		$getSolusiRefraksi = $this->m_account->collectSolusiBy("Kelainan Refraksi");
		$valKatarak; $valGlukoma; $valRefraksi;
		
		foreach($getSolusiKatarak as $katarak)
		{
			$valKatarak = $katarak->solusi;
		}
		foreach($getSolusiGlukoma as $glukoma)
		{
			$valGlukoma = $glukoma->solusi;
		}
		foreach($getSolusiRefraksi as $refraksi)
		{
			$valRefraksi = $refraksi->solusi;
		}
		
		$data['allResult'][0] = (object) array('nilai' => $resultDefuzzyfikasiKatarak , 
												'result' => $resultKatarak,
												'solusi' => $valKatarak);
		$data['allResult'][1] = (object) array('nilai' => $resultDefuzzyfikasiGlukoma , 
												'result' => $resultGlukoma,
												'solusi' => $valGlukoma);
		$data['allResult'][2] = (object) array('nilai' => $resultDefuzzyfikasiRefraksi , 
												'result' => $resultRefraksi,
												'solusi' => $valRefraksi);
												
		$this->load->view('viewResult', $data);
		
	}
	public function tambahSolusi()
	{
		$this->data['posts'] = $this->m_account->collectSolusi();
		$this->load->view('viewSolusi', $this->data);
	}
	public function postTambahSolusi()
	{
		$data["penyakit"] = $this->input->post('penyakit');
		$data["solusi"] = $this->input->post('solusi');
		$this->m_account->addSolusi($data);
		$this->data['posts'] = $this->m_account->collectSolusi();
		$this->load->view('viewSolusi', $this->data);
		
	}
	public function deleteSolusi($data)
	{
		$this->m_account->deleteSolusi($data);
		$this->data['posts'] = $this->m_account->collectSolusi();
		$this->load->view('viewSolusi', $this->data);
	}
	
 }