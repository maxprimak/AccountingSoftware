<?php

namespace Modules\Companies\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Companies\Entities\Company;
use Modules\Users\Entities\User;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Warehouses\Entities\Warehouse;
use Modules\Companies\Entities\Address;

use BranchesService;
use Modules\Documents\Entities\Receipt;

class Branch extends Model
{
    protected $fillable = ['name', 'company_id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);
    }

    public function store(FormRequest $request){

        $user = User::where('login_id', auth('api')->user()->id)->first();

        $this->company_id = Company::find($user->company_id)->id;
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->color = $request->color;

        $address = new Address();
        $address->store($request);

        $this->address_id = $address->id;
        $this->save();

        BranchesService::addUserToBranches($user->id, array($this->id));
        $request->branch_id = $this->id;
        $warehouse = new Warehouse();
        $warehouse->store($request);

        return $this;
    }

    public function storeUpdated(FormRequest $request){
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->color = $request->color;

        $address = Address::find($this->address_id);
        $address->store($request);

        $this->address_id = $address->id;
        $this->save();
        $this->saveStandardReceiptMainText();

        $warehouse = Warehouse::where('branch_id',$this->id)->first();
        $warehouse = $warehouse->storeUpdate($request);

        return $this;
    }

    public function saveStandardReceiptMainText(){

        Receipt::create([
            'branch_id' => $this->id,
            'language_id' => 1,
            'main_text' => "Service Center is not responsible for any data loss in the device memory associated with the replacement of memory cards, software installation, replacement of hard drives. Repairs take 14 business days from receiving the device to the service center. In the absence of repair parts repair period is extended by agreement of both parties."
        ]);
        Receipt::create([
            'branch_id' => $this->id,
            'language_id' => 2,
            'main_text' => "Das Reparatur Geschäft ist nicht verantwortlich für Datenverluste im Gerätespeicher, die mit dem Austausch von Speicherkarten, der Softwareinstallation und dem Austausch von Festplatten verbunden sind. Reparaturen dauern bis 14 Werktage ab Erhalt des Geräts beim Servicecenter. In Ermangelung von Ersatzteilen verlängert sich die Reparaturfrist nach Vereinbarung beider Parteien."
        ]);
        Receipt::create([
            'branch_id' => $this->id,
            'language_id' => 3,
            'main_text' => "Ремонтная мастерская не несет ответственности за потерю данных в памяти устройства, связанную с заменой карт памяти, установкой программного обеспечения и заменой жестких дисков. Ремонт занимает до 14 рабочих дней с момента получения устройства в сервисном центре. При отсутствии запчастей срок ремонта будет продлен по согласованию обеих сторон."
        ]);

    }

    public function getAddress(){
        return Address::findOrFail($this->address_id);
    }

}
