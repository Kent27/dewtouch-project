<?php
	class FormatController extends AppController{
		
		public function q1(){
			
			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
        }
        
        // Show result after clicking button Save
        public function save(){
            $this->setFlash('This is the Result');
            
            $this->set('option',$this->request->data['Type']['type']);
			
			$this->set('title',__('Chosen Record'));
			
        }
		
	}