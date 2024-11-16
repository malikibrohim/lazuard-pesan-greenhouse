<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use GuzzleHttp\Client;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class BerandaController extends Controller
{
    //

    public function index()
    {
        $produks = Product::all();
        return view('welcome', compact('produks'));
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

    public function pesanProduk(Request $request)
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
        $order->save();
        $customer->save();

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

        return redirect('/')->with('success', 'Pemesanan berhasil disimpan! No. Pesanan : ' . $no_pesanan);
    }
}
