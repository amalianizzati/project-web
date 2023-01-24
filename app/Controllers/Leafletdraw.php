<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TbldatapointModel;
use App\Models\TbldatapolylineModel;
use App\Models\TbldatapolygonModel;

class Leafletdraw extends BaseController
{
    protected $TbldatapointModel;
    protected $TbldatapolylineModel;
    protected $TbldatapolygonModel;

    public function __construct()
    {
        $this->TbldatapointModel = new TbldatapointModel();
        $this->TbldatapolygonModel = new TbldatapolygonModel();
        $this->TbldatapolylineModel = new TbldatapolylineModel();
    }
    public function index()
    {
        return view('leafletdraw/v_create');
    }

    public function simpan_point()
    {
        $data = [
            'nama' => $this->request->getPost('input_point_name'),
            'geom' => $this->request->getPost('input_point_geometry'),
        ];

        $this->TbldatapointModel->save($data);
        return redirect()->to('leafletdraw');
    }

    public function simpan_polyline()
    {
        $data = [
            'nama' => $this->request->getPost('input_polyline_name'),
            'geom' => $this->request->getPost('input_polyline_geometry'),
        ];

        $this->TbldatapolylineModel->save($data);
        return redirect()->to('leafletdraw');
    }

    public function simpan_polygon()
    {
        $data = [
            'nama' => $this->request->getPost('input_polygon_name'),
            'geom' => $this->request->getPost('input_polygon_geometry'),
        ];

        $this->TbldatapolygonModel->save($data);
        return redirect()->to('leafletdraw');
    }

    public function delete()
    {
        return view('leafletdraw/v_delete');
    }
    public function hapusdatapolygon()
    {
        $id = $this->request->getPost('id');
        $this->TbldatapolygonModel->delete($id);
    }

    public function hapusdatapolyline()
    {
        $id = $this->request->getPost('id');
        $this->TbldatapolylineModel->delete($id);
    }

    public function hapusdatapoint()
    {
        $id = $this->request->getPost('id');
        $this->TbldatapointModel->delete($id);
    }


    public function edit()
    {
        return view('leafletdraw/v_edit');
    }

    public function edit_polygon($id)
    {
        $data = [
            'idpolygon' => $id
        ];
        return view('leafletdraw/v_edit_polygon', $data);
    }

    public function simpan_edit_geom_polygon()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'geom' => $this->request->getPost('geom')
        ];
        $this->TbldatapolygonModel->save($data);
    }

    public function simpan_edit_data_polygon()
    {
        $data = [
            'id' => $this->request->getPost('id_polygon'),
            'nama' => $this->request->getPost('edit_polygon_name'),
            'deskripsi' => $this->request->getPost('edit_polygon_deskripsi'),
        ];

        $this->TbldatapolygonModel->save($data);
        return redirect()->to('leafletdraw/edit');
    }
    public function edit_polyline($id)
    {
        $data = [
            'idpolyline' => $id
        ];
        return view('leafletdraw/v_edit_polyline', $data);
    }

    public function simpan_edit_geom_polyline()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'geom' => $this->request->getPost('geom')
        ];
        $this->TbldatapolylineModel->save($data);
    }

    public function simpan_edit_data_polyline()
    {
        $data = [
            'id' => $this->request->getPost('id_polyline'),
            'nama' => $this->request->getPost('edit_polyline_name'),
            'deskripsi' => $this->request->getPost('edit_polyline_deskripsi'),
        ];

        $this->TbldatapolylineModel->save($data);
        return redirect()->to('leafletdraw/edit');
    }

    public function edit_point($id)
    {
        $data = [
            'idpoint' => $id
        ];
        return view('leafletdraw/v_edit_point', $data);
    }

    public function simpan_edit_geom_point()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'geom' => $this->request->getPost('geom')
        ];
        $this->TbldatapointModel->save($data);
    }

    public function simpan_edit_data_point()
    {
        $data = [
            'id' => $this->request->getPost('id_point'),
            'nama' => $this->request->getPost('edit_point_name'),
            'deskripsi' => $this->request->getPost('edit_point_deskripsi'),
        ];

        $this->TbldatapointModel->save($data);
        return redirect()->to('leafletdraw/edit');
    }
}
