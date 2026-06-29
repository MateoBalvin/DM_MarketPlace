<?php

namespace App\Livewire\Admin\Sale\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class SaleDetailModal extends Component
{
    public function render()
    {
        return view('livewire.admin.sale.modals.sale-detail-modal');
    }

    #[On('OpenSaleDetailModal')]
    public function openModal()
    {
        $this->dispatch('open-modal', 'sale-detail-modal');
    }
}
