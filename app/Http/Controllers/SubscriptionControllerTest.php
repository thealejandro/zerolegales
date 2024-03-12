<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionControllerTest extends Controller
{
    public function create(Request $request)
    {
        // Obtener los datos del formulario de solicitud
        $planId = $request->input('plan_id');
        $userId = Auth::user()->id;

        // Configurar los datos de la suscripción
        $subscriptionData = [
            'merchant_id' => config('cybersource.merchant_id'),
            // Otros datos de la suscripción...
        ];

        // Utilizar el SDK de Cybersource para crear la suscripción
        $subscription = Client::createSubscription($subscriptionData);

        // Procesar la respuesta de Cybersource y almacenar la información de la suscripción en tu base de datos
        // Manejar errores y redireccionar según sea necesario
    }

    public function update(Request $request, $subscriptionId)
    {
        // Obtener los datos del formulario de actualización
        $newPlanId = $request->input('new_plan_id');

        // Utilizar el SDK de Cybersource para actualizar la suscripción
        $updatedSubscription = Client::updateSubscription($subscriptionId, ['plan_id' => $newPlanId]);

        // Procesar la respuesta de Cybersource y actualizar la información de la suscripción en tu base de datos
        // Manejar errores y redireccionar según sea necesario
    }

    public function cancel($subscriptionId)
    {
        // Utilizar el SDK de Cybersource para cancelar la suscripción
        $canceledSubscription = Client::cancelSubscription($subscriptionId);

        // Procesar la respuesta de Cybersource y marcar la suscripción como cancelada en tu base de datos
        // Manejar errores y redireccionar según sea necesario
    }
}
