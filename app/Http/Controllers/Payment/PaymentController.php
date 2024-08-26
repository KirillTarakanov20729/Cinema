<?php

namespace App\Http\Controllers\Payment;

use App\Application\Services\Payment\DTO\ChangePaymentStatusDTO;
use App\Application\Services\Payment\DTO\ShowPaymentDTO;
use App\Application\Services\Payment\DTO\StorePaymentDTO;
use App\Application\Services\Payment\PaymentService;
use App\Application\Services\Stripe\StripeService;
use App\Application\Services\Ticket\DTO\ShowTicketDTO;
use App\Application\Services\Ticket\TicketService;
use App\Domain\Models\Payment\Enum\PaymentStatusEnum;
use App\Domain\Models\Payment\Payment;
use App\Domain\Models\Payment\Resource\PaymentResource;
use App\Domain\Models\Ticket\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/**
 * @OA\Post(
 *     path="/api/payments/store",
 *     summary="Store payment",
 *     tags={"Payments"},
 *
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="ticket_id",
 *                     type="integer",
 *                     description="Ticket ID",
 *                     example=1
 *                 ),
 *                 @OA\Property(
 *                     property="user_id",
 *                     type="integer",
 *                     description="User ID",
 *                     example=1
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Store payment"
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/payments/redirect/{payment_uuid}",
 *     summary="Redirect to payment",
 *     tags={"Payments"},
 *     @OA\Parameter(
 *         name="payment_uuid",
 *         in="path",
 *         required=true
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Redirect to payment"
 *     )
 * ),
 */
class PaymentController extends Controller
{
    private PaymentService $paymentService;
    private TicketService $ticketService;

    private StripeService $stripeService;

    public function __construct(PaymentService $paymentService, TicketService $ticketService, StripeService $stripeService)
    {
        $this->paymentService = $paymentService;
        $this->ticketService = $ticketService;
        $this->stripeService = $stripeService;
    }

    public function store(StorePaymentRequest $request): PaymentResource|JsonResponse
    {
        try {
            $ticket = $this->fetchTicket($request->validated('ticket_id'));

            $payment = $this->processPayment($ticket, $request->validated('user_id'));

            return new PaymentResource($payment);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function redirect(string $payment_uuid): JsonResponse
    {
        try {
            $payment = $this->paymentService->getPayment(new ShowPaymentDTO(['payment_uuid' => $payment_uuid]));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        try {
            $session = $this->stripeService->createSession($payment);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        try {
            $payment = $this->paymentService->changeStatus(new ChangePaymentStatusDTO([
                'payment' => $payment,
                'status' => PaymentStatusEnum::in_progress]));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        return response()->json(['url' => $session->url], 200);
    }

    public function success(string $payment_uuid): JsonResponse
    {
        return response()->json(['message' => 'Payment ' . $payment_uuid . ' success'], 200);
    }

    public function failure(string $payment_uuid): JsonResponse
    {
        return response()->json(['message' => 'Payment ' . $payment_uuid . ' failure'], 200);
    }

    public function callback(Request $request): JsonResponse
    {
        try {
            $this->stripeService->callback($request);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        return response()->json(['message' => ''], 200);
    }

    private function fetchTicket(int $ticketId): Ticket
    {
        $data_for_ticket = new ShowTicketDTO(['ticket_id' => $ticketId]);

        return $this->ticketService->show($data_for_ticket);
    }

    private function processPayment(Ticket $ticket, int $userId): Payment
    {
        $data_for_store = new StorePaymentDTO(['ticket' => $ticket, 'user_id' => $userId]);

        return $this->paymentService->store($data_for_store);
    }
}

