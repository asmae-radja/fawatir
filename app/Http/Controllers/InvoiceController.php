<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payement;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }
    public function invoicesPayees()
    {
        $invoices = Invoice::where('value_Status', 1)->get();
        return view('invoices.invoices', compact('invoices'));
    }
    public function invoicesPartiellementPayees()
    {
        $invoices = Invoice::where('value_Status', 3)->get();
        return view('invoices.invoices', compact('invoices'));
    }

    public function invoicesNonPayees()
    {
        $invoices = Invoice::where('value_Status', 2)->get();
        return view('invoices.invoices', compact('invoices'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'invoice_num' => 'required|unique:invoices|max:255',
            'section_id' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'product' => 'required',
        ]);


        Invoice::create([
            'invoice_num' => $request->invoice_num,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            'status' => 'non payee',
            'value_Status' => 2,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);
        session()->flash('Add', 'Ajouté avec succès');
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sections = Section::all();
        $invoice = Invoice::where('id', $id)->first();
        //dd($invoice);
        return view('invoices.update', compact('invoice', 'sections'));
    }


    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->update([
            'invoice_num' => $request->invoice_num,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            //  'product' => $request->product,
            'section_id' => $request->section_id,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vat' => $request->rate_vat,
            'total' => $request->total,
            //'status' => 'non payee',
            //'value_Status' => 2,
            'note' => $request->note,
            'user' => Auth::user()->name,
        ]);
        session()->flash('edit', 'Modification avec succès');
        return redirect()->route('invoices.index');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        $id = $request->id;
        Invoice::find($id)->delete();
        session()->flash('delete', 'Suppression avec succès');
        return redirect('/invoices');
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("name", "id");
        return json_encode($products);
    }


    public function addMontant(Request $request)
    {

        $request->validate([
            'date_payements' => 'required|date',
            'montant_payements' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::find($request->id);

        if (!$invoice) {
            return redirect()->back()->with('error', 'Facture introuvable.');
        }

        Payement::create([
            'invoice_id' => $request->id,
            'date_payements' => $request->input('date_payements'),
            'montant_payements' => $request->input('montant_payements'),
        ]);
        $totalPayments = Payement::where('invoice_id', $request->id)->sum('montant_payements');

        if ($totalPayments < $invoice->total) {
            $invoice->update([
                'value_Status' => 3,
                'status' => 'partiellement payee',
            ]);
        } elseif ($totalPayments == $invoice->total) {
            $invoice->update([
                'value_Status' => 1,
                'status' => 'payee',
            ]);
        }
        return redirect()->back()->with('success', 'Paiement ajouté avec succès.');
    }


    /**
     *  public function generatePDF($id)
     * {
     *
     *   // dd(111);
     *    $invoice = Invoice::findOrFail($id);
     *
     *    // Générer le PDF
     *   $pdf = new Dompdf();
     *   $pdf->loadHtml(view('invoices.pdf', compact('invoice')));

     *   // Options pour le PDF (facultatif)
     *  $options = new Options();
     *  $options->set('isHtml5ParserEnabled', true);
     *  $options->set('isPhpEnabled', true);

     *  $pdf->setOptions($options);

     *  // Rendre le PDF
     * $pdf->render();

     * // Afficher le PDF dans le navigateur ou télécharger
     * return $pdf->stream('invoice.pdf');
     * } */
}
