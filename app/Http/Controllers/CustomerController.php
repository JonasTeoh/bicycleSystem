<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
  public function index()
  {
    $customer = Customer::all();
    return view('customer.index', compact('customer'));
  }

  public function create()
  {
    return view('customer.create');
  }

  public function store(Request $request)
  {
    $input = $request->all();
    Customer::create($input);
    session()->flash('success', 'Added a new customer!');
    return redirect('customer');
  }

  public function destroy($id)
  {
    Customer::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('customer');
  }

  public function edit($id)
  {
    $customer = Customer::find($id);
    return view('customer.edit', compact('customer'))->with('customer', $customer);
  }

  public function update(Request $request, $id)
  {
    $input = $request->all();
    $customer = Customer::find($id);
    $customer->update($input);
    session()->flash('success', 'Customer updated!');
    return redirect('customer');
  }

  public function show($id)
  {
    $customer = Customer::find($id);
    return view('customer.show')->with('customer', $customer);
  }

  public function export()
  {
    $currentTime = Carbon::now('Asia/Shanghai')->format('Y_m_d_H_i_s'); // Generate a timestamp by following timezone UTC+8
    $fileName = "customers_" . $currentTime . ".xlsx";
    return Excel::download(new CustomersExport, $fileName);
  }
}
