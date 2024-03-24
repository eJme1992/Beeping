<div>

   <p class="h1">Listado de Pedidos</p>
    <hr>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Referencia</th>
                <th>Nombre del Cliente</th>
                <th>Total Qty</th>
            </tr>
        </thead>
        <tbody>
            @if($orders)
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_ref }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->orderLines->count() > 0 ? $order->orderLines->sum('qty') : 0}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No hay pedidos.</td>
                </tr>
            @endif
        </tbody>
    </table>
     {{ $orders->links() }}
    <div>
        Último registro en la tabla 'executed': 
        Pedidos: {{ $totalOrders }} - Total: {{ $totalCost }} - ({{ $lastExecuted ? $lastExecuted->created_at : 'No hay registros' }})
    </div>
</div>
