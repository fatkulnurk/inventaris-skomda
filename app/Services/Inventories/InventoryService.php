<?php

namespace App\Services\Inventories;

use App\Models\Inventory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InventoryService
{
    public function get(string $search = '', array $options = [
        'limit' => 10,
        'page' => 1,
        'sort' => 'asc',
        'order_by' => 'name',
    ]): LengthAwarePaginator
    {
        return Inventory::query()
            ->when(filled($search), function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy($options['order_by'], $options['sort'])
            ->paginate(
                perPage: $options['limit'],
                columns: ['*'],
                pageName: 'page',
                page: $options['page']
            );
    }

    private function findItem(string $identifier): Builder|Model|null
    {
        return (Inventory::query()
            ->where(function ($query) use ($identifier) {
                $query->where('id', $identifier)->orWhere('code', $identifier);
            })
            ->first()) ?? null;
    }

    public function showByQrCode(string $code): Builder|Model|null
    {
        return $this->findItem($code);
    }
}
