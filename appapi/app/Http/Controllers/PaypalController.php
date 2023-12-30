<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use Illuminate\Support\Facades\Http;

use App\Models\Payment;

class PaypalController extends Controller
{
  //
  public function viewpaypal(Request $request)
  {
    return view('paypalpages.viewpaypal');
  }

  public function paypal2()
  {
    // $provider = new PayPalClient;
    $provider = new PayPalClient;
    // $provider = \PayPal::setProvider();

    $provider->setApiCredentials(config('paypal'));

    $paypalToken = $provider->getAccessToken();

    //     $data = json_decode('{
//   "product_id": "PROD-XXCD1234QWER65782",
//   "name": "Video Streaming Service Plan",
//   "description": "Video Streaming Service basic plan",
//   "status": "ACTIVE",
//   "billing_cycles": [
//     {
//       "frequency": {
//         "interval_unit": "MONTH",
//         "interval_count": 1
//       },
//       "tenure_type": "TRIAL",
//       "sequence": 1,
//       "total_cycles": 2,
//       "pricing_scheme": {
//         "fixed_price": {
//           "value": "3",
//           "currency_code": "USD"
//         }
//       }
//     },
//     {
//       "frequency": {
//         "interval_unit": "MONTH",
//         "interval_count": 1
//       },
//       "tenure_type": "TRIAL",
//       "sequence": 2,
//       "total_cycles": 3,
//       "pricing_scheme": {
//         "fixed_price": {
//           "value": "6",
//           "currency_code": "USD"
//         }
//       }
//     },
//     {
//       "frequency": {
//         "interval_unit": "MONTH",
//         "interval_count": 1
//       },
//       "tenure_type": "REGULAR",
//       "sequence": 3,
//       "total_cycles": 12,
//       "pricing_scheme": {
//         "fixed_price": {
//           "value": "10",
//           "currency_code": "USD"
//         }
//       }
//     }
//   ],
//   "payment_preferences": {
//     "auto_bill_outstanding": true,
//     "setup_fee": {
//       "value": "10",
//       "currency_code": "USD"
//     },
//     "setup_fee_failure_action": "CONTINUE",
//     "payment_failure_threshold": 3
//   },
//   "taxes": {
//     "percentage": "10",
//     "inclusive": false
//   }
// }', true);

    // $plan = $provider->createPlan([
    //   "product_id" => "PROD-XXCD1234QWER65782",
    //   "name" => "Video Streaming Service Plan",
    //   "billing_cycles" => [
    //     [
    //       "tenure_type" => "TRIAL",
    //       "sequence" => 1,
    //       "frequency" => [
    //         "interval_unit" => "MONTH",
    //         "interval_count" => 1
    //       ],
    //       "total_cycles" => 2,
    //       "pricing_scheme" => [
    //         "fixed_price" => [
    //           "value" => "3",
    //           "currency_code" => "USD"
    //         ]
    //       ]
    //     ],
    //     [
    //       "frequency" => [
    //         "interval_unit" => "MONTH",
    //         "interval_count" => 1
    //       ],
    //       "tenure_type" => "TRIAL",
    //       "sequence" => 2,
    //       "total_cycles" => 3,
    //       "pricing_scheme" => [
    //         "fixed_price" => [
    //           "value" => "6",
    //           "currency_code" => "USD"
    //         ]
    //       ]
    //     ],
    //     [
    //       "frequency" => [
    //         "interval_unit" => "MONTH",
    //         "interval_count" => 1
    //       ],
    //       "tenure_type" => "REGULAR",
    //       "sequence" => 3,
    //       "total_cycles" => 12,
    //       "pricing_scheme" => [
    //         "fixed_price" => [
    //           "value" => "10",
    //           "currency_code" => "USD"
    //         ]
    //       ]
    //     ]
    //   ],
    //   "payment_preferences" => [
    //     "auto_bill_outstanding" => true,
    //     "setup_fee" => [
    //       "value" => "10",
    //       "currency_code" => "USD"
    //     ],
    //     "setup_fee_failure_action" => "CONTINUE",
    //     "payment_failure_threshold" => 3
    //   ],
    //   "description" => "Video Streaming Service basic plan",
    //   "status" => "ACTIVE",
    //   "taxes" => [
    //     "percentage" => "10",
    //     "inclusive" => false
    //   ]
    // ]);
    // dd($plan);


    // $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE')
    //   ->addPlanTrialPricing('DAY', 7)
    //   ->addDailyPlan('Demo Plan', 'Demo Plan', 1.50)
    //   ->setReturnAndCancelUrl('http://192.168.1.14:8000/success', 'http://192.168.1.14:8000/cancel')
    //   ->setupSubscription('John Doe', 'john@example.com', '2023-12-10');

    $data = json_decode('{
  "product_id": "PROD-XXCD1234QWER65782",
  "name": "Video Streaming Service Plan",
  "description": "Video Streaming Service basic plan",
  "status": "ACTIVE",
  "billing_cycles": [
    {
      "frequency": {
        "interval_unit": "MONTH",
        "interval_count": 1
      },
      "tenure_type": "TRIAL",
      "sequence": 1,
      "total_cycles": 2,
      "pricing_scheme": {
        "fixed_price": {
          "value": "3",
          "currency_code": "USD"
        }
      }
    },
    {
      "frequency": {
        "interval_unit": "MONTH",
        "interval_count": 1
      },
      "tenure_type": "TRIAL",
      "sequence": 2,
      "total_cycles": 3,
      "pricing_scheme": {
        "fixed_price": {
          "value": "6",
          "currency_code": "USD"
        }
      }
    },
    {
      "frequency": {
        "interval_unit": "MONTH",
        "interval_count": 1
      },
      "tenure_type": "REGULAR",
      "sequence": 3,
      "total_cycles": 12,
      "pricing_scheme": {
        "fixed_price": {
          "value": "10",
          "currency_code": "USD"
        }
      }
    }
  ],
  "payment_preferences": {
    "auto_bill_outstanding": true,
    "setup_fee": {
      "value": "10",
      "currency_code": "USD"
    },
    "setup_fee_failure_action": "CONTINUE",
    "payment_failure_threshold": 3
  },
  "taxes": {
    "percentage": "10",
    "inclusive": false
  }
}', true);

    // $plan = $provider->createPlan($data);
    $provider = new PayPalClient;
    // $provider = \PayPal::setProvider();

    $provider->setApiCredentials(config('paypal'));

    $paypalToken = $provider->getAccessToken();
    $plan_id = 'P-7GL4271244454362WXNWU5NQ';

    // $plan = $provider->activatePlan($plan_id);

    // $plans = $provider->listPlans();

    // $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE')
    //     ->addPlanTrialPricing('DAY', 7)
    //     ->addMonthlyPlan('Demo Plan', 'Demo Plan', 100)
    //     ->setReturnAndCancelUrl('https://example.com/paypal-success', 'https://example.com/paypal-cancel')
    //     ->setupSubscription('John Doe', 'john@example.com', '2021-12-10');


    // $data = json_decode('{
    //     "product_id": "PROD-XXCD1234QWER65782",
    //     "name": "Video Streaming Service Plan",
    //     "description": "Video Streaming Service basic plan",
    //     "status": "ACTIVE",
    //     "billing_cycles": [
    //         {
    //         "frequency": {
    //             "interval_unit": "MONTH",
    //             "interval_count": 1
    //         },
    //         "tenure_type": "TRIAL",
    //         "sequence": 1,
    //         "total_cycles": 2,
    //         "pricing_scheme": {
    //             "fixed_price": {
    //             "value": "3",
    //             "currency_code": "USD"
    //             }
    //         }
    //         },
    //         {
    //         "frequency": {
    //             "interval_unit": "MONTH",
    //             "interval_count": 1
    //         },
    //         "tenure_type": "TRIAL",
    //         "sequence": 2,
    //         "total_cycles": 3,
    //         "pricing_scheme": {
    //             "fixed_price": {
    //             "value": "6",
    //             "currency_code": "USD"
    //             }
    //         }
    //         },
    //         {
    //         "frequency": {
    //             "interval_unit": "MONTH",
    //             "interval_count": 1
    //         },
    //         "tenure_type": "REGULAR",
    //         "sequence": 3,
    //         "total_cycles": 12,
    //         "pricing_scheme": {
    //             "fixed_price": {
    //             "value": "10",
    //             "currency_code": "USD"
    //             }
    //         }
    //         }
    //     ],
    //     "payment_preferences": {
    //         "auto_bill_outstanding": true,
    //         "setup_fee": {
    //         "value": "10",
    //         "currency_code": "USD"
    //         },
    //         "setup_fee_failure_action": "CONTINUE",
    //         "payment_failure_threshold": 3
    //     },
    //     "taxes": {
    //         "percentage": "10",
    //         "inclusive": false
    //     }
    //     }', true);

    // $plan = $provider->createPlan(
    //     [
    //         "product_id" => "PROD-XXCD1234QWER65782",
    //         "name" => "Video Streaming Service Plan",
    //         "billing_cycles" => [
    //             [
    //                 "tenure_type" => "TRIAL",
    //                 "sequence" => 1,
    //                 "frequency" => [
    //                     "interval_unit" => "MONTH",
    //                     "interval_count" => 1
    //                 ],
    //                 "total_cycles" => 2,
    //                 "pricing_scheme" => [
    //                     "fixed_price" => [
    //                         "value" => "3",
    //                         "currency_code" => "USD"
    //                     ]
    //                 ]
    //             ],
    //             [
    //                 "frequency" => [
    //                     "interval_unit" => "MONTH",
    //                     "interval_count" => 1
    //                 ],
    //                 "tenure_type" => "TRIAL",
    //                 "sequence" => 2,
    //                 "total_cycles" => 3,
    //                 "pricing_scheme" => [
    //                     "fixed_price" => [
    //                         "value" => "6",
    //                         "currency_code" => "USD"
    //                     ]
    //                 ]
    //             ],
    //             [
    //                 "frequency" => [
    //                     "interval_unit" => "MONTH",
    //                     "interval_count" => 1
    //                 ],
    //                 "tenure_type" => "REGULAR",
    //                 "sequence" => 3,
    //                 "total_cycles" => 12,
    //                 "pricing_scheme" => [
    //                     "fixed_price" => [
    //                         "value" => "10",
    //                         "currency_code" => "USD"
    //                     ]
    //                 ]
    //             ]
    //         ],
    //         "payment_preferences" => [
    //             "auto_bill_outstanding" => true,
    //             "setup_fee" => [
    //                 "value" => "10",
    //                 "currency_code" => "USD"
    //             ],
    //             "setup_fee_failure_action" => "CONTINUE",
    //             "payment_failure_threshold" => 3
    //         ],
    //         "description" => "Video Streaming Service basic plan",
    //         "status" => "ACTIVE",
    //         "taxes" => [
    //             "percentage" => "10",
    //             "inclusive" => false
    //         ]
    //     ]
    // );

    //     $data = json_decode('{
    //     "product_id": "10001",
    //     "name": "Pet Owner 1 month",
    //     "description": "Pet owner basic plan",
    //     "status": "ACTIVE",
    //     "billing_cycles": [
    //         {
    //         "frequency": {
    //             "interval_unit": "MONTH",
    //             "interval_count": 1
    //         },

    //         "tenure_type": "REGULAR",
    //         "sequence": 3,
    //         "total_cycles": 12,
    //         "pricing_scheme": {
    //             "fixed_price": {
    //             "value": "10",
    //             "currency_code": "USD"
    //             }
    //         }
    //         }
    //     ],
    //             "payment_preferences": {
    //                 "auto_bill_outstanding": true,
    //                 "setup_fee": {
    //                 "value": "10",
    //                 "currency_code": "USD"
    //                 },
    //                 "setup_fee_failure_action": "CONTINUE",
    //                 "payment_failure_threshold": 3
    //             },

    //   }', true);

    // $response = $provider->createPlan($data); 
    // $response = $provider->createPlan([


    //     "product_id" => "10001",
    //     "name" => "Pet Owner 1 month",
    //     "description" => "Pet owner basic plan",
    //     "status" => "ACTIVE",
    //     "billing_cycles" => [
    //         [
    //             "frequency" => [
    //                 "interval_unit" => "MONTH",
    //                 "interval_count" => 1
    //             ],

    //             "tenure_type" => "REGULAR",
    //             "sequence" => 3,
    //             "total_cycles" => 12,
    //             "pricing_scheme" => [
    //                 "fixed_price" => [
    //                     "value" => "10",
    //                     "currency_code" => "USD"
    //                 ]
    //             ]
    //         ]
    //     ],
    //     "payment_preferences" => [
    //         "auto_bill_outstanding" => true,
    //         "setup_fee" => [
    //             "value" => "10",
    //             "currency_code" => "USD"
    //         ],
    //         "setup_fee_failure_action" => "CONTINUE",
    //         "payment_failure_threshold" => 3
    //     ],
    //     true
    // ]);



    // if (isset($response['id']) && $response['id'] != null) {
    //     foreach ($response['links'] as $link) {
    //         if ($link['rel'] === 'approve') {

    //             // session()->put('product_name', $request->product_name);
    //             // session()->put('quantity', $request->quantity);
    //             return redirect()->away($link['href']);
    //         }
    //     }
    // } else {
    //     return redirect()->route('cancel');

    // }



    $data = $data = [
      'product_id' => 10001,
      'quantity' => '1',
      'shipping_amount' => [
        'currency_code' => 'USD',
        'value' => 10.00,
      ],
      'subscriber' => [
        'name' => [
          'given_name' => 'Johhny',
          'surname' => '',
        ],
        'email_address' => "johhnydeluxe@gmail.com",
        'shipping_address' => [
          'name' => [
            'full_name' => "Jonny" . '-' . 101,
          ],
          'address' => 'Sikatuna',
        ],
      ],
      'application_context' => [
        'brand_name' => env('PAYPAL_PRODUCT_ID'),
        'locale' => 'en-US',
        'shipping_preference' => 'SET_PROVIDED_ADDRESS',
        'user_action' => 'SUBSCRIBE_NOW',
        'payment_method' => [
          'payer_selected' => 'PAYPAL',
          'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED',
        ],
        'return_url' => route('success'),
        'cancel_url' => route('cancel'),
      ],
    ];

    $plan = $provider->createPlan($data);

    dd($plan);

    // $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE')
    //     ->addPlanTrialPricing('DAY', 7)
    //     ->addMonthlyPlan('Demo Plan', 'Demo Plan', 100)
    //     ->setReturnAndCancelUrl('https://example.com/paypal-success', 'https://example.com/paypal-cancel')
    //     ->setupSubscription('John Doe', 'john@example.com', '2021-12-10');



    // dd($response);



  }

  public function paypal(Request $request)
  {
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));

    $paypalToken = $provider->getAccessToken();

    $response = $provider->createOrder([
      "intent" => "CAPTURE",
      "application_context" => [
        "return_url" => route('success'),
        "cancel_url" => route('cancel'),

      ],

      "purchase_units" => [
        [
          "amount" => [
            "currency_code" => "USD",
            "value" => $request->price
          ]
        ]
      ]
    ]);

    if (isset($response['id']) && $response['id'] != null) {
      foreach ($response['links'] as $link) {
        if ($link['rel'] === 'approve') {

          session()->put('product_name', $request->product_name);
          session()->put('quantity', $request->quantity);
          return redirect()->away($link['href']);
        }
      }
    } else {
      return redirect()->route('cancel');

    }

  }

  public function success(Request $request)
  {
    //input to database
    // dd($request);

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $paypalToken = $provider->getAccessToken();
    $response = $provider->capturePaymentOrder($request->token);
    dd($response);

    // if (isset($response['status']) && $response['status'] == 'COMPLETED') {

    //     unset($_SESSION['product_name']);
    //     unset($_SESSION['qunatity']);


    //     //insert data to database
    //     $payment = new Payment;
    //     $payment->payment_id = $response['id'];
    //     $payment->product_name = session()->get('product_name');
    //     $payment->quantity = session()->get('quantity');
    //     $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
    //     $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
    //     $payment->payer_name = $response['payer']['name']['given_name'] . ' ' . $response['payer']['name']['surname'];
    //     $payment->payer_email = $response['payer']['email_address'];
    //     $payment->payment_status = $response['status'];
    //     $payment->payment_method = "PayPal";
    //     // $payment->payment_method = $response['purchase_units'][0]['payments']['captures'][0]['payment_method'];
    //     $payment->save();


    // return "Payment is successful.";

    //     //unset the session


    // } else {
    //     return redirect()->route('cancel');

    // }



  }

  public function cancel()
  {
    return "Payment is cancelled.";

  }

  public function createPlan()
  {
    $provider = new PayPalClient;
    // $provider = \PayPal::setProvider();

    $provider->setApiCredentials(config('paypal'));

    $paypalToken = $provider->getAccessToken();

    $data = json_decode('{
  "product_id": "PROD-XXCD1234QWER65782",
  "name": "Video Streaming Service Plan",
  "description": "Video Streaming Service basic plan",
  "status": "ACTIVE",
  "billing_cycles": [
    {
      "frequency": {
        "interval_unit": "MONTH",
        "interval_count": 1
      },
      "tenure_type": "TRIAL",
      "sequence": 1,
      "total_cycles": 2,
      "pricing_scheme": {
        "fixed_price": {
          "value": "3",
          "currency_code": "USD"
        }
      }
    },
    {
      "frequency": {
        "interval_unit": "MONTH",
        "interval_count": 1
      },
      "tenure_type": "TRIAL",
      "sequence": 2,
      "total_cycles": 3,
      "pricing_scheme": {
        "fixed_price": {
          "value": "6",
          "currency_code": "USD"
        }
      }
    },
    {
      "frequency": {
        "interval_unit": "MONTH",
        "interval_count": 1
      },
      "tenure_type": "REGULAR",
      "sequence": 3,
      "total_cycles": 12,
      "pricing_scheme": {
        "fixed_price": {
          "value": "10",
          "currency_code": "USD"
        }
      }
    }
  ],
  "payment_preferences": {
    "auto_bill_outstanding": true,
    "setup_fee": {
      "value": "10",
      "currency_code": "USD"
    },
    "setup_fee_failure_action": "CONTINUE",
    "payment_failure_threshold": 3
  },
  "taxes": {
    "percentage": "10",
    "inclusive": false
  }
}', true);

    $plan = $provider->createPlan($data);

  }
  public function activate()
  {
    $provider = new PayPalClient;
    // $provider = \PayPal::setProvider();

    $provider->setApiCredentials(config('paypal'));

    $paypalToken = $provider->getAccessToken();
    $plan_id = 'P-7GL4271244454362WXNWU5NQ';

    $plan = $provider->activatePlan($plan_id);
    dd($plan);
  }

  ///////////////////////////////////////////////////////////-subscription

  // public function createproduct(Request $request)
  // {
  //     $provider = new PayPalClient;
  //     $provider->getAccessToken();

  //     $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE')
  //         ->addPlanTrialPricing('DAY', 7)
  //         ->addMonthlyPlan('Demo Plan', 'Demo Plan', 100)
  //         ->setReturnAndCancelUrl('https://example.com/paypal-success', 'https://example.com/paypal-cancel')
  //         ->setupSubscription('John Doe', 'john@example.com', '2021-12-10');
  //     $plans = $provider->listPlans();

  //     $data = json_decode('{
  //         "product_id": "PROD-XXCD1234QWER65782",
  //         "name": "Video Streaming Service Plan",
  //         "description": "Video Streaming Service basic plan",
  //         "status": "ACTIVE",
  //         "billing_cycles": [
  //             {
  //             "frequency": {
  //                 "interval_unit": "MONTH",
  //                 "interval_count": 1
  //             },
  //             "tenure_type": "TRIAL",
  //             "sequence": 1,
  //             "total_cycles": 2,
  //             "pricing_scheme": {
  //                 "fixed_price": {
  //                 "value": "3",
  //                 "currency_code": "USD"
  //                 }
  //             }
  //             },
  //             {
  //             "frequency": {
  //                 "interval_unit": "MONTH",
  //                 "interval_count": 1
  //             },
  //             "tenure_type": "TRIAL",
  //             "sequence": 2,
  //             "total_cycles": 3,
  //             "pricing_scheme": {
  //                 "fixed_price": {
  //                 "value": "6",
  //                 "currency_code": "USD"
  //                 }
  //             }
  //             },
  //             {
  //             "frequency": {
  //                 "interval_unit": "MONTH",
  //                 "interval_count": 1
  //             },
  //             "tenure_type": "REGULAR",
  //             "sequence": 3,
  //             "total_cycles": 12,
  //             "pricing_scheme": {
  //                 "fixed_price": {
  //                 "value": "10",
  //                 "currency_code": "USD"
  //                 }
  //             }
  //             }
  //         ],
  //         "payment_preferences": {
  //             "auto_bill_outstanding": true,
  //             "setup_fee": {
  //             "value": "10",
  //             "currency_code": "USD"
  //             },
  //             "setup_fee_failure_action": "CONTINUE",
  //             "payment_failure_threshold": 3
  //         },
  //         "taxes": {
  //             "percentage": "10",
  //             "inclusive": false
  //         }
  //         }', true);

  //     $plan = $provider->createPlan($data);
  // }
}
