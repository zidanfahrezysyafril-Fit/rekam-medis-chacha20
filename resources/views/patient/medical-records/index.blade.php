<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-500 flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-notes-medical"></i>
            </div>
            Riwayat Rekam Medis Saya
        </div>
    </x-slot>

    <div class="glass-card rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">No. Rekam Medis</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Tgl Pemeriksaan</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Dokter Pemeriksa</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status Data</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($records as $record)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-md bg-slate-100 text-slate-800 border border-slate-200 font-mono">{{ $record->medical_record_number }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">
                                {{ \Carbon\Carbon::parse($record->examination_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-slate-900">{{ $record->doctor->doctor_name }}</div>
                                <div class="text-xs text-slate-500">{{ $record->doctor->specialization }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                    <i class="fa-solid fa-lock text-green-500"></i> Diamankan (ChaCha20)
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('patient.medical-records.show', $record) }}" class="text-cyan-600 hover:text-cyan-900 bg-cyan-50 hover:bg-cyan-100 p-2 rounded-lg transition-colors" title="Lihat & Dekripsi">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('patient.medical-records.pdf', $record) }}" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Download PDF">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-2xl text-slate-400 mx-auto mb-4">
                                    <i class="fa-solid fa-file-medical"></i>
                                </div>
                                <p class="text-slate-500 font-medium">Anda belum memiliki riwayat rekam medis di sistem ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($records instanceof \Illuminate\Pagination\LengthAwarePaginator && $records->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                {{ $records->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
