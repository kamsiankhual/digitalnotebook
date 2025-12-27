@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="text-gray-500 text-sm font-medium uppercase">Total Notes</div>
            <div class="mt-2 text-3xl font-bold text-indigo-600">{{ $totalNotes }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="text-gray-500 text-sm font-medium uppercase">Total Users</div>
            <div class="mt-2 text-3xl font-bold text-green-600">{{ $totalUsers }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="text-gray-500 text-sm font-medium uppercase">My Contributions</div>
            <div class="mt-2 text-3xl font-bold text-blue-600">{{ $myNotesCount }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Notes by Category</h3>
            <div class="relative h-64 w-full">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Global Activity</h3>
            <div class="space-y-4">
                @foreach($recentNotes as $note)
                    <div class="flex items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                            {{ substr($note->user->name, 0, 1) }}
                        </div>
                        <div class="ml-3 w-full">
                            <div class="flex justify-between">
                                <p class="text-sm font-medium text-gray-900">{{ $note->title }}</p>
                                <span class="text-xs text-gray-400">{{ $note->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-gray-500">by {{ $note->user->name }} in <span class="text-indigo-600">{{ $note->category->name }}</span></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(ctx, {
            type: 'doughnut', // You can change this to 'bar', 'pie', 'line'
            data: {
                labels: {!! json_encode($categoryNames) !!}, // Output PHP array as JSON
                datasets: [{
                    label: '# of Notes',
                    data: {!! json_encode($categoryCounts) !!}, // Output PHP array as JSON
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.6)', // Indigo
                        'rgba(16, 185, 129, 0.6)', // Green
                        'rgba(245, 158, 11, 0.6)', // Amber
                        'rgba(239, 68, 68, 0.6)',  // Red
                        'rgba(59, 130, 246, 0.6)', // Blue
                        'rgba(139, 92, 246, 0.6)', // Purple
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    </script>
@endsection