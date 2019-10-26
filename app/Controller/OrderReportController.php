<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
            // debug($portions);exit;
            
            // Get Query Data
            $options=array(
                'fields' => array(
                    'Order.id', 'Order.name', 'od.quantity', 'i.name', 'p.name', 'parts.name', 'pd.value'
                ),             
                'joins' =>
                        array(
                            array(
                                'table' => 'order_details',
                                'alias' => 'od',
                                'type' => 'left',
                                'foreignKey' => false,
                                'conditions'=> array('Order.id = od.order_id')
                            ),
                            array(
                                'table' => 'items',
                                'alias' => 'i',
                                'type' => 'left',
                                'foreignKey' => false,
                                'conditions'=> array('i.id = od.item_id')
                            ), 
                            array(
                                'table' => 'portions',
                                'alias' => 'p',
                                'type' => 'left',
                                'foreignKey' => false,
                                'conditions'=> array('p.item_id = i.id')
                            ),
                            array(
                                'table' => 'portion_details',
                                'alias' => 'pd',
                                'type' => 'left',
                                'foreignKey' => false,
                                'conditions'=> array('pd.portion_id = p.id')
                            ),
                            array(
                                'table' => 'parts',
                                'alias' => 'parts',
                                'type' => 'left',
                                'foreignKey' => false,
                                'conditions'=> array('parts.id = pd.part_id')
                            )               
                        ) 
            );

            $result = $this->Order->find('all', $options);
            // End (Get Query Data)

            // Fill Query Data into Array
            $order_reports2 = [];
            foreach($result as $data){
                // if Order array doesn't exist yet
                if(!isset($order_reports2[$data['Order']['name']])){
                    $order_reports2[$data['Order']['name']] = [];
                }

                // if Part already exist
                if(isset($order_reports2[$data['Order']['name']][$data['parts']['name']])){
                    $order_reports2[$data['Order']['name']][$data['parts']['name']] += ($data['od']['quantity'] * $data['pd']['value']);
                }
                else{
                    $order_reports2[$data['Order']['name']][$data['parts']['name']] = ($data['od']['quantity'] * $data['pd']['value']);
                }      
            }
            // End (Fill Query Data into Array)

            // sort (just for visual purposes)
            ksort($order_reports2);
            $temp = $order_reports2['Order 10'];
            unset($order_reports2['Order 10']);
            $order_reports2 ['Order 10'] = $temp;
            // End (sort)

			$this->set('order_reports',$order_reports2);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}