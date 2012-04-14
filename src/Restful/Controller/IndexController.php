<?php
/**
 * IndexController
 * 
 * @file: IndexController.php
 * @author: Komang Arthayasa <komang@fogitive.com>
 */

namespace Restful\Controller
{
    use Zend\Mvc\Controller\RestfulController;
    
    class IndexController extends RestfulController
    {
        public function getList()
        {
            return array(
                1 => array(
                    'id' => 1,
                    'title' => 'Title #1',
                ),
                2 => array(
                    'id' => 2,
                    'title' => 'Title #2',
                ),
            );
        }
        
        public function get($id)
        {
            return array(
                'id' => $id,
                'title' => 'Title #1',
            );
        }
        
        public function create($data)
        {
            
        }
        
        public function update($id, $data)
        {
            
        }
        
        public function delete($id)
        {
            
        }
    }
}

