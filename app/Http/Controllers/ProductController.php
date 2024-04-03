<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\SaleReport;
use App\Rules\DateLessThanNowRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy("created_at", "desc")->paginate(5);
        return Inertia::render('Shop/ListProduct', [
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        return Inertia::render('Shop/CreateProduct', []);
    }

    public function reportList()
    {

        $reports = SaleReport::orderBy("created_at", "desc")->paginate(5);

        return Inertia::render('Reports/ListReport', ["reports" => $reports]);
    }

    public function createReport()
    {
        return Inertia::render('Reports/CreateReport');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $body = $request->validated();

        $body["image"] = "/images/default-product.jpg";
        Auth::user()->products()->create($body);

        return redirect(route('product.list', absolute: false));
    }

    public function storeReport(Request $request)
    {
        $body = $request->validate([
            'title' => "required|string|max:100",
            'begin_date' => ["required", "date", new DateLessThanNowRule],
            'end_date' => ["required", "date", new DateLessThanNowRule],
        ]);

        $report = Auth::user()->reports()->create($body);

        return redirect(route('product.report.show', ["saleReport" => $report->id], absolute: false));
    }

    public function showReport($saleReportId)
    {
        $saleReport = SaleReport::where(["id" => $saleReportId])
            ->with("user")
            ->firstOrFail();

        $totalRevenue = ProductSale::selectRaw("COALESCE(SUM(price), 0) AS total_price")
            ->selectRaw("COALESCE(SUM(cost), 0) AS total_cost")
            ->selectRaw("COALESCE(SUM(tax), 0) AS total_taxes")
            ->whereDate("created_at", ">=", $saleReport->begin_date)
            ->whereDate("created_at", "<=", $saleReport->end_date)
            ->first();


        $sales = ProductSale::orderBy("created_at", "desc")
            ->whereDate("created_at", ">=", $saleReport->begin_date)
            ->whereDate("created_at", "<=", $saleReport->end_date)
            ->with(["product" => function ($query) {
                $query->withTrashed();
            }])
            ->with("user")
            ->get();

        $data = [
            "saleReport" => $saleReport,
            "totalRevenue" => $totalRevenue,
            "sales" => $sales,
        ];

        return Inertia::render('Reports/ShowReport', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $currencies = Currency::all();
        $data = ["product" => $product, "currencies" => $currencies];

        return Inertia::render('Shop/ViewProduct', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Shop/EditProduct', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest  $request, Product $product)
    {
        $body = $request->validated();
        $body["image"] = "/images/default-product.jpg";
        $product->update($body);

        return redirect(route('product.show', ["product" => $product->id], absolute: false));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('product.list', absolute: false));
    }
}
