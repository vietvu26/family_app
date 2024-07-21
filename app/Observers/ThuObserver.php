<?php

namespace App\Observers;

use App\Models\Thu;
use App\Models\Dong;
use App\Models\Person;

class ThuObserver
{
    /**
     * Handle the Thu "created" event.
     */
    public function created(Thu $thu): void
    {
        $peopleRecords = Person::all();

        foreach ($peopleRecords as $people) {
            Dong::create([
                'thu_id' => $thu->id,
                'person_id' => $people->id,
                'amount' => 0, // Giá trị mặc định, bạn có thể thay đổi nếu cần
                'status' => false,
            ]);
        }
    }
}
