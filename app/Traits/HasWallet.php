<?php

namespace App\Traits;

use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasWallet {
    protected function defaultWalletName()
    {
        return "wallet.primary_wallet"; // base on langs
    }

    public function createDefaultWallet()
    {
        $payload = [
            [
                'name' => $this->defaultWalletName(),
                'user_id' => $this->id,
                'saldo' => 0,
                'wallet_category_id' => Wallet::SAVING_TYPE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'wallet.expense_wallet', // base on langs
                'user_id' => $this->id,
                'saldo' => 0,
                'wallet_category_id' => Wallet::EXPENSE_TYPE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Wallet::insert($payload);

        return true;
    }

    public function createWallet(array $data = [])
    {
        $default = [
            'user_id' => $this->id,
            'name' => $this->defaultWalletName(),
            'saldo' => 0,
            'wallet_category_id' => Wallet::SAVING_TYPE,
        ];

        if (count($data) > 0) {
            if ((isset($data['name'])) && (!empty($data['name']))) {
                $default['name'] = $data['name'];
            }
            if ((isset($data['wallet_category_id'])) && (!empty($data['wallet_category_id']))) {
                $default['wallet_category_id'] = $data['wallet_category_id'];
            }
            if ((isset($data['is_have_target'])) && (!empty($data['is_have_target']))) {
                $default['is_have_target'] = $data['is_have_target'];
            }
            if ((isset($data['target_amount'])) && (!empty($data['target_amount']))) {
                $default['target_amount'] = $data['target_amount'];
            }
            if ((isset($data['target_timeline'])) && (!empty($data['target_timeline']))) {
                $default['target_timeline'] = $data['target_timeline'];
            }
            if ((isset($data['base_color'])) && (!empty($data['base_color']))) {
                $default['base_color'] = $data['base_color'];
            }
        }

        return Wallet::create($default);
    }

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class, 'user_id');
    }

    public function wallet($walletId)
    {
        return Wallet::find($walletId);
    }

    private function generateAccountNumber()
    {

    }
}
