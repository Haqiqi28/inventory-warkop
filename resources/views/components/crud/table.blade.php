@props([
    'headers' => [],
])

<div class="card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0">

                @if(count($headers))

                    <thead class="table-primary">

                        <tr>

                            @foreach($headers as $header)

                                <th>

                                    {{ $header }}

                                </th>

                            @endforeach

                        </tr>

                    </thead>

                @endif

                <tbody>

                    {{ $slot }}

                </tbody>

            </table>

        </div>

    </div>

</div>