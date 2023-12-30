<?php

namespace App\Paypal;

class CreatePlan extends Paypal
{
    public function create()
    {


        $plan = new Plan();
        $plan->setName("Pet owner monthly plan")
            ->setDescription('Template Creation.')
            ->setType('fixed');


    }

}