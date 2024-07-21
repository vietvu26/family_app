<?php

namespace App\Observers;


use App\Models\Dong;
use App\Models\Person;
use App\Models\Thu;

class PeopleObserver
{
    /**
     * Handle the People "created" event.
     */
    public function created(Person $people): void
    {
        $thuRecords = Thu::all();

        foreach ($thuRecords as $thu) {
            Dong::create([
                'thu_id' => $thu->id,
                'person_id' => $people->id,
                'amount' => 0, // Giá trị mặc định, bạn có thể thay đổi nếu cần
                'status' => false,
            ]);
        }
    }
}
