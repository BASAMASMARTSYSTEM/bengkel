<?php
class Pengguna_model  extends CI_Model  {

    var $table = 'tpengguna';
    var $column_order = array('Nama','Username','NoTelp','Status',null); //kolom untuk pengurutan
    var $column_search = array('Nama','Username','NoTelp','Status'); //kolom yang ingin dicari
    var $order = array('KodePengguna' => 'desc'); // default order 


    function __construct()
    {
        parent::__construct();
    }


    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }


    private function _get_datatables_query()
    {
        
        $this->db->from($this->table);

        $i = 0;
    
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function save($data)
    {       
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();        
    }


    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }


    public function get_by_kode($KodePengguna)
    {
        $this->db->from($this->table);
        $this->db->where('KodePengguna',$KodePengguna);
        $query = $this->db->get();

        return $query->row();
    }


    public function delete_by_kode($KodePengguna)
    {
        $this->db->where('KodePengguna', $KodePengguna);
        $this->db->delete($this->table);
    }



}