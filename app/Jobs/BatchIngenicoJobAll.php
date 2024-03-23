<?php

namespace App\Jobs;


use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use ErrorRegister;
use Exception;


class BatchIngenicoJobAll extends Job implements ShouldQueue
{
    
    use InteractsWithQueue, SerializesModels;

    protected $batch;
    protected $batchDetails;
    protected $operator;
    protected $creditCardRepository;
    protected $onlinePaymentRepository;
    protected $accountRepository;
    protected $paymentBatchRepository;
    protected $ingenicoOperationDetailRepository;

    public function __construct($batchdetails, $operator, $paymentBatchDB)
    {
        $this->batchDetails = $batchdetails;
        $this->operator = $operator;
        $this->batch = $paymentBatchDB;
    }

    /**
     * Execute the job.
    
    public function handle(
        ICreditCardRepository $creditCardRepo,
        IOnlinePaymentRepository $onlinePaymentRepo,
        IAccountRepository $accountRepo,
        Dispatcher $dispatcher,
        IPaymentBatchRepository $paymentBatchRepo,
        IIngenicoOperationDetailRepository $ingenicoOperationDetailRepository
    ) {
        $this->paymentBatchRepository = $paymentBatchRepo;
        $this->creditCardRepository = $creditCardRepo;
        $this->onlinePaymentRepository = $onlinePaymentRepo;
        $this->accountRepository = $accountRepo;
        $this->ingenicoOperationDetailRepository = $ingenicoOperationDetailRepository;
    
     
    }
   
     */

}