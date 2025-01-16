<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Booking ID
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Guest
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Room
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Check In
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Check Out
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
{{--        @foreach($bookings as $booking)--}}
{{--            <tr>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                    #{{ $booking->id }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                    {{ $booking->user->name }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                    {{ $booking->room->name }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                    {{ $booking->check_in_date->format('M d, Y') }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                    {{ $booking->check_out_date->format('M d, Y') }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full--}}
{{--                        @if($booking->status === 'confirmed') bg-green-100 text-green-800--}}
{{--                        @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800--}}
{{--                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800--}}
{{--                        @endif">--}}
{{--                        {{ ucfirst($booking->status) }}--}}
{{--                    </span>--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-sm">--}}
{{--                    <a href="{{ route('receptionist.bookings.show', $booking) }}"--}}
{{--                       class="text-indigo-600 hover:text-indigo-900">View</a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>

{{--    <div class="p-4">--}}
{{--        {{ $bookings->links() }}--}}
{{--    </div>--}}
</div>
