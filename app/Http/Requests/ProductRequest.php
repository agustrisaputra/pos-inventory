<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $productId = optional($this->product)->id;

        return [
            'code'              => "required|unique:products,code,{$productId},id,deleted_at,NULL",
            'name'              => "required|unique:products,name,{$productId},id,deleted_at,NULL",
            'category'          => 'required',
            'stock'             => 'required|numeric|min:1',
            'price'             => 'required',
            'reseller_price'    => 'required',
            'store_price'       => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'price'             => str_replace('.', '', $this->price),
            'reseller_price'    => str_replace('.', '', $this->reseller_price),
            'store_price'       => str_replace('.', '', $this->store_price)
        ]);
    }

    public function attributes()
    {
        return [
            'code'              => 'Kode',
            'name'              => 'Nama',
            'category'          => 'Jenis Kategori',
            'stock'             => 'Stok',
            'price'             => 'Harga',
            'reseller_price'    => 'Harga Reseller',
            'store_price'       => 'Harga Toko'
        ];
    }
}
