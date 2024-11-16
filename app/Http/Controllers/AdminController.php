<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Customer;

class AdminController extends Controller
{

    // produk

    public function index()
    {
        $jumlahProduk = Product::count();
        $jumlahPemesanan = Order::count();

        return view('dashboard', compact('jumlahProduk', 'jumlahPemesanan'));
    }

    public function produkIndex()
    {
        $products = Product::paginate(3);
        return view('produk', compact('products'));
    }


    public function simpanProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori_produk' => 'required',
            'stok_produk' => 'required|numeric',
            'harga_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'image_produk' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = new Product();
        $product->nama_produk = $request->input('nama_produk');
        $product->kategori_produk = $request->input('kategori_produk');
        $product->stok_produk = $request->input('stok_produk');
        $product->harga_produk = $request->input('harga_produk');
        $product->deskripsi_produk = $request->input('deskripsi_produk');

        if ($request->file('image_produk')) {
            $image_path = $request->file('image_produk')->store('images', 'public');
            $product->image_produk = $image_path;
        }

        $product->save();
        return redirect('produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function produkHapus($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('produk')->with('success', 'Produk berhasil dihapus');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('edit', compact('product'));
    }

    public function updateProduk(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return redirect('produk')->with('success', 'Produk berhasil diubah');
    }

    //Pemesanan

    public function pemesananIndex()
    {
        $pemesanan = Order::paginate(3);
        $produk = Product::all();

        return view('pemesanan', compact('pemesanan', 'produk'));
    }


    public function simpanPemesanan(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'nama_produk' => 'required',
            'jumlah' => 'required|numeric',
            'status' => 'required',
            'total_harga' => 'required|numeric',
        ]);

        $order = new Order();
        $customer = new Customer();
        $order->nama_customer = $request->input('nama_customer');
        $customer->nama_customer = $request->input('nama_customer');
        $order->alamat = $request->input('alamat');
        $customer->alamat = $request->input('alamat');
        $order->no_telp = $request->input('no_telp');
        $customer->no_telp = $request->input('no_telp');
        $order->nama_produk = $request->input('nama_produk');
        $order->jumlah = $request->input('jumlah');
        $order->status = $request->input('status');
        $order->total_harga = $request->input('total_harga');
        $no_pesanan = $this->generateNoPesanan();
        $order->no_pesanan = $no_pesanan;
        $customer->save();
        $order->save();

        $phoneNumber = $request->input('no_telp');
        $message = "Halo " . $request->input('nama_customer') . "\n";
        $message .= "Pesanan anda berhasil dibuat." . "\n" . "\n";
        $message .= "Detail Pemesanan :\n";
        $message .= "Nama : " . $request->input('nama_customer') . "\n";
        $message .= "Alamat : " . $request->input('alamat') . "\n";
        $message .= "Nama Produk : " . $request->input('nama_produk') . "\n";
        $message .= "Ukuran Meter² : " . $request->input('jumlah') . " meter² \n";
        $message .= "Total Harga : Rp. " . number_format($order->total_harga, 0, ',', '.') . "\n";
        $message .= "No. Pesanan : *" . $order->no_pesanan . "*\n \n";
        $message .= "Terima kasih telah memesan Greenhouse di tempat kami!" . "\n";
        $message .= "Silahkan lakukan pembayaran agar pesanan anda segera kami proses.";
        $messageTambahan = "Kirim bukti pembayaran dengan membalas pesan ini.";
        $this->sendWhatsappMessage($phoneNumber, $message);
        $this->sendWhatsappMessage($phoneNumber, $messageTambahan);

        return redirect('pemesanan')->with('success', 'Pemesanan berhasil disimpan! No. Pesanan: ' . $no_pesanan);
    }

    function generateNoPesanan($length = 20)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sendWhatsappMessage($phoneNumber, $message)
    {
        $client = new Client();
        $instanceId = env('ULTRAMSG_INSTANCE_ID');
        $apiKey = env('ULTRAMSG_API_KEY');
        $url = "https://api.ultramsg.com/{$instanceId}/messages/chat";

        $response = $client->post($url, [
            'form_params' => [
                'token' => $apiKey,
                'to' => $phoneNumber,
                'body' => $message,
            ],
        ]);

        return $response->getBody();
    }

    public function hapusPemesanan($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        $message = "Halo " . $order->nama_customer . ", pemesanan Anda dengan nomor *" . $order->no_pesanan . "* telah dihapus! Silahkan buat pemesanan ulang.";
        $this->sendWhatsappMessage($order->no_telp, $message);

        return redirect('pemesanan')->with('success', "Pemesanan dengan nomor {$order->no_pesanan} berhasil dihapus!");
    }

    public function updatePemesanan(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());

        if ($order->status == 'proses') {
            $message = "Halo " . $order->nama_customer . ", pesanan Anda dengan nomor *" . $order->no_pesanan . "* sedang diproses!";
        } elseif ($order->status == 'terkirim') {
            $message = "Halo " . $order->nama_customer . ", pesanan Anda dengan nomor *" . $order->no_pesanan . "* telah terkirim!";
        } elseif ($order->status == 'selesai') {
            $message = "Halo " . $order->nama_customer . ", terimakasih sudah memesan produk Greenhouse dari PT. Lazuard Agritech. \n \n \n \n Admin \n ";
        }

        if ($order->status == 'proses' || $order->status == 'terkirim' || $order->status == 'selesai') {
            $this->sendWhatsappMessage($order->no_telp, $message);
        }

        return redirect('pemesanan')->with('success', 'Pemesanan berhasil diubah!');
    }


    public function customerIndex()
    {
        $customer = Customer::all();
        return view('customer', compact('customer'));
    }


    public function customerHapus($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('customer')->with('success', 'Data customer berhasil dihapus!');
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());
        return redirect('customer')->with('success', 'Data Customer berhasil diubah');
    }

    public function tambahCustomer(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
        ]);

        $customer = new Customer();
        $customer->nama_customer = $request->input('nama_customer');
        $customer->alamat = $request->input('alamat');
        $customer->no_telp = $request->input('no_telp');
        $customer->save();

        return redirect('customer')->with('success', 'Data Customer berhasil ditambahkan!');
    }
}
