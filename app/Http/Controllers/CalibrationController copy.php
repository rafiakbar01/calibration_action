<?php

namespace App\Http\Controllers;

use App\Models\Calibration;
use App\Models\HeadInsideMicrometer;
use App\Models\DetailInsideMicrometer;
use App\Models\HeadOutsideMicrometer;
use App\Models\DetailOutsideMicrometer;
use App\Models\AddOutsideMicrometer;
use App\Models\HeadDepthMicrometer;
use App\Models\DetailDepthMicrometer;
use App\Models\DetailThermometer;
use App\Models\HeadThermometer;
use App\Models\HeadDialIndicator;
use App\Models\DetailDialIndicator;
use App\Models\AddDialIndicator;
use App\Models\AddDialTestIndicator;
use App\Models\DetailDialTestIndicator;
use App\Models\HeadDialTestIndicator;
use App\Models\DetailDepthCaliper;
use App\Models\HeadDepthCaliper;
use App\Models\HeadCaliper;
use App\Models\DetailCaliper;
use App\Models\AddCaliper;
use App\Models\HeadTorqueWrench;
use App\Models\DetailTorqueWrench;
use App\Models\AddTorqueWrench;
use App\Models\HeadTorqueMeter;
use App\Models\DetailTorqueMeter;
use App\Models\AddTorqueMeter;
use App\Models\HeadThicknessGauge;
use App\Models\DetailThicknessGauge;
use App\Models\HeadPenggaris;
use App\Models\DetailPenggaris;
use App\Models\HeadEnclosure;
use App\Models\DetailEnclosure;
use App\Models\AddEnclosure;
use App\Models\HeadChamber;
use App\Models\DetailChamber;
use App\Models\AddChamber;
use App\Models\HeadPressureGauge;
use App\Models\DetailPressureGauge;
use App\Models\AddPressureGauge;
use App\Models\HeadDifferentialPressureGauge;
use App\Models\DetailDifferentialPressureGauge;
use App\Models\AddDifferentialPressureGauge;
use App\Models\HeadVolumetrik;
use App\Models\DetailVolumetrik;
use App\Models\AddVolumetrik;
use App\Models\HeadViscometer;
use App\Models\DetailViscometer;
use App\Models\HeadPushpull;
use App\Models\detailPushpull;
use App\Models\addPushpull;
use App\Models\HeadTimbangan;
use App\Models\detailTimbangan;
use App\Models\addTimbangan;
use App\Models\HeadTimbanganMoisture;
use App\Models\detailTimbanganMoisture;
use App\Models\addTimbanganMoisture;
use App\Models\HeadTimbanganBias;
use App\Models\detailTimbanganBias;
use App\Models\addTimbanganBias;
use App\Models\HeadGaugeBlock;
use App\Models\DetailGaugeBlock;
use App\Models\AddGaugeBlock;
use App\Models\HeadHoletest;
use App\Models\DetailHoletest;
use App\Models\HeadConductivityMeter;
use App\Models\detailConductivityMeter;
use App\Models\HeadCoatingThickness;
use App\Models\detailCoatingThickness;
use App\Models\HeadDurometer;
use App\Models\DetailDurometer;
use App\Models\AddDurometer;
use App\Models\HeadMikropipetDispenset;
use App\Models\DetailMikropipetDispenset;
use App\Models\HeadTaperGauge;
use App\Models\DetailTaperGauge;
use App\Models\HeadFeelerGauge;
use App\Models\DetailFeelerGauge;
use App\Models\HeadPhMeter;
use App\Models\DetailPhMeter;
use App\Models\HeadTachometer;
use App\Models\DetailTachometer;
use App\Models\HeadPinGauge;
use App\Models\DetailPinGauge;
use App\Models\HeadViscoCup;
use App\Models\DetailViscoCup;
use App\Models\AddViscoCup;
use App\Models\HeadPlainLimitGauge;
use App\Models\DetailPlainLimitGauge;
use App\Models\HeadTempHumidTransmitter;
use App\Models\Detail_T_TempHumidTransmitter;
use App\Models\Detail_RH_TempHumidTransmitter;
use App\Models\HeadTempTransmitter;
use App\Models\DetailTempTransmitter;
use App\Models\HeadIrThermometer;
use App\Models\DetailIrThermometer;
use App\Models\AddIrThermometer;
use App\Models\HeadThermoIndicator;
use App\Models\DetailThermoIndicator;
use App\Models\AddThermoIndicator;
use App\Models\HeadPlasticShim;
use App\Models\DetailPlasticShim;
use App\Models\HeadProfilProjector;
use App\Models\DetailProfilProjector;
use App\Models\HeadSurfaceRoughnessTester;
use App\Models\DetailSurfaceRoughnessTester;
use App\Models\HeadUltrasonicThicknessGauge;
use App\Models\DetailUltrasonicThicknessGauge;
use App\Models\HeadThreadGauge;
use App\Models\DetailThreadGauge;
use App\Models\HeadStopwatch;
use App\Models\DetailStopwatch;
use App\Models\HeadCentrifuge;
use App\Models\DetailCentrifuge;
use App\Models\HeadUtm;
use App\Models\DetailUtm;
use App\Models\HeadAnakTimbangan;
use App\Models\DetailAnakTimbangan;
use App\Models\HeadPressureTransmitter;
use App\Models\DetailPressureTransmitter;
use App\Models\AddPressureTransmitter;
use App\Models\HeadSurfacePlate;
use App\Models\DetailSurfacePlate;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Carbon\Carbon;


class CalibrationController extends Controller
{
    public function create()
    {
        return view('calibrations.create');
    }

            public function getFormHtml($formType)
    {
        $resolution = request()->query('resolution');
        $capacity = request()->query('capacity');
        $repetition = request('repetition', 1); 
        $type = request()->query('type'); // Untuk thermohygrometer
        $timbanganType = request()->query('timbangan_type'); // ⬅️ UNTUK JENIS TIMBANGAN
        
        switch($formType) {
            case 'inside_micrometer':
                // Kirim variabel $capacity ke view
                return view('formhtml.inside_micrometer', compact('capacity'))->render();

            case 'outside_micrometer':
                return view('formhtml.outside_micrometer', compact('capacity'))->render();

            case 'thread_gauge':
                return view('formhtml.thread_gauge', compact('capacity'))->render();

            case 'depth_micrometer':
                return view('formhtml.depth_micrometer', compact('capacity'))->render();
                
            case 'thermometer':
                return view('formhtml.thermometer')->render();

             case 'surface_plate':
                return view('formhtml.surface_plate')->render();

            case 'profil_projector':
                return view('formhtml.profil_projector')->render();

            case 'taper_gauge':
                return view('formhtml.taper_gauge')->render();

            case 'bore_gauge':
                return view('formhtml.bore_gauge')->render();

            case 'anak_timbang':
                return view('formhtml.anak_timbang')->render();

            case 'utm':
                return view('formhtml.utm')->render();

        
            case 'dial_indicator':
                // Kirim variabel $resolution ke view
                return view('formhtml.dial_indicator', compact('resolution'))->render();

            case 'dial_test_indicator':
                // Kirim variabel $resolution ke view
                return view('formhtml.dial_test_indicator', compact('resolution'))->render();
                
            case 'depth_caliper':
                return view('formhtml.depth_caliper')->render();

            case 'caliper':
                // Kirim variabel $capacity ke view
                return view('formhtml.caliper', compact('capacity'))->render();

            case 'tachometer':
                // Kirim variabel $capacity ke view
                return view('formhtml.tachometer', compact('capacity'))->render();

            case 'torque_wrench':
                return view('formhtml.torque_wrench')->render();
                
            case 'torque_meter':
                return view('formhtml.torque_meter')->render();
                
            case 'thickness_gauge':
                return view('formhtml.thickness_gauge')->render();

              case 'visco_cup':
                return view('formhtml.visco_cup')->render();
                
            case 'penggaris':
                return view('formhtml.penggaris')->render();  
                
            case 'enclosure':
                return view('formhtml.enclosure', compact('repetition'))->render();

            case 'thermoindicator':
                return view('formhtml.thermoindicator', compact('repetition'))->render();
                
            case 'chamber':
                return view('formhtml.chamber', compact('repetition'))->render();

            case 'pressure_gauge':
                return view('formhtml.pressure_gauge')->render();
                
            
            case 'thermometer_infrared':
                return view('formhtml.thermometer_infrared')->render(); 

            case 'differential_pressure_gauge':
                return view('formhtml.differential_pressure_gauge')->render();  

            case 'volumetrik':
                return view('formhtml.volumetrik')->render();  

            case 'thermohygrometer':
                // Pilih view berdasarkan type
                if ($type === 'in_out') {
                    return view('formhtml.thermohygrometer_in_out')->render();
                } else {
                    return view('formhtml.thermohygrometer')->render();
                }

            case 'viscometer':
                return view('formhtml.viscometer')->render();  
                
            case 'push_pull':
                return view('formhtml.push_pull')->render();  
                
            case 'timbangan':
                // ⬅️ HANYA 2 PILIHAN: TIMBANGAN STANDAR ATAU MOISTURE
                if ($timbanganType === 'moisture') {
                    return view('formhtml.timbangan_moisture')->render();
                } else {
                    // Default: timbangan standar
                    return view('formhtml.timbangan')->render();

                }

            case 'timbangan_bias':
                return view('formhtml.timbangan_bias')->render();  

            case 'gauge_block':
                return view('formhtml.gauge_block')->render();  

            case 'holetest':
                return view('formhtml.holetest')->render();  

            case 'conductivity_meter':
                return view('formhtml.conductivity_meter')->render();  

            case 'coating_thickness':
                return view('formhtml.coating_thickness')->render();  

            case 'mikropipet_dispenset':
                return view('formhtml.mikropipet_dispenset')->render();  


            case 'temp_humid_transmitter':
                return view('formhtml.temp_humid_transmitter')->render();


            case 'insulation':
                // Pilih view berdasarkan type
                if ($type === 'ac_voltage_50hz') {
                    return view('formhtml.insulation_ac_voltage_50hz')->render();
                } 
                if ($type === 'dc_voltage') {
                    return view('formhtml.insulation_dc_voltage')->render();
                }
                if ($type === 'ac_current_50hz') {
                    return view('formhtml.insulation_ac_current_50hz')->render();
                }
                if ($type === 'dc_current') {
                    return view('formhtml.insulation_dc_current')->render();
                }
                if ($type === 'voltage_output_test') {
                    return view('formhtml.insulation_voltage_output_test')->render();
                }
                if ($type === 'dc_voltage_output_test') {
                    return view('formhtml.insulation_dc_voltage_output_test')->render();
                }else {
                    // Default: timbangan standar
                    return view('formhtml.insulation_ac_voltage_50hz')->render();

                }


            case 'centrifuge':
                return view('formhtml.centrifuge')->render();

            case 'plastic_shim':
                return view('formhtml.plastic_shim')->render();

            case 'durometer':
                return view('formhtml.durometer')->render();

            case 'feeler_gauge':
                return view('formhtml.feeler_gauge')->render();

            case 'stopwatch':
                return view('formhtml.stopwatch')->render();

            case 'plain_limit_gauge':
                return view('formhtml.plain_limit_gauge')->render();

            case 'surface_roughness_tester':
                return view('formhtml.surface_roughness_tester')->render();

            case 'ph_meter':
                return view('formhtml.ph_meter')->render();

            case 'pin_gauge':
                return view('formhtml.pin_gauge')->render();

            case 'ultrasonic_thickness_gauge':
                return view('formhtml.ultrasonic_thickness_gauge')->render();

            case 'pressure_transmitter':
                return view('formhtml.pressure_transmitter')->render();

            case 'thermo_indicator':
                return view('formhtml.thermo_indicator')->render();

            case 'temperature_transmitter':
                return view('formhtml.temperature_transmitter')->render();

          






                break;

            default:
                return response()->json(['error' => 'Form tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        \Log::info('🎯 STORE METHOD CALLED');
        
        try {
            // Validasi
            $request->validate([
                'form_type' => 'required',
                'nama_alat' => 'required',
                'merek' => 'required',
                'kode_alat' => 'nullable',
                'type_alat' => 'nullable',
                'no_seri' => 'required',
                'kapasitas' => 'required',
                'resolusi' => 'required',
                'rentang_ukur_min' => 'nullable',
                'rentang_ukur_max' => 'nullable',
                'nama_pemilik' => 'required',
                'tanggal_alat_masuk' => 'required|date',
                'tanggal_kalibrasi' => 'required|date',
                'jenis_pembacaan' => 'nullable',
                'tempat_kalibrasi' => 'required',
                'lokasi_pt' => 'nullable',
                'fungsi_komponen' => 'required',
                'suhu_awal' => 'required',
                'suhu_tengah' => 'required',
                'suhu_akhir' => 'required',
                'rh_awal' => 'required',
                'rh_tengah' => 'required',
                'rh_akhir' => 'required',
                'alat_standar_text' => 'required_without:alat_standar|string',
                'alat_standar'      => 'nullable|array',
                'indicator'      => 'nullable|array',
                'media'      => 'nullable|array',
                'alat_standar.*'    => 'string',
                'calibrated_by' => 'required',
                'verified_by' => 'required',
                'type' => 'nullable', // ⬅️ TAMBAHAN
            ]);
    
            
            \Log::info('✅ VALIDATION PASSED');
            \Log::info('🔍 Checking no_seri field:', ['no_seri' => $request->no_seri]); // ✅ DEBUG NO_SERI
    
            $formType = $request->form_type ?? 'default';
            
            // Generate certificate_id
            $certificateId = $this->generateCertificateId($request->nama_alat);
    
            // Get NIK dan nama dari user yang login
            $userNik = auth()->user()->nik;
            $userName = auth()->user()->nama; 
            
            // Tentukan LK berdasarkan form type
            $lkCode = $this->getLkCodeByFormType($formType);
    
            // ✅ SESUAI MODEL: Gunakan method dari model
            $initialStatus = Calibration::STATUS_WAITING_VERIFICATION;
            
            // Data untuk Calibration table
            $calibrationData = [
                'NIK' => $userNik,
                'LK' => $lkCode,
                'jenisPembacaan' => $request->jenis_pembacaan,
                'lokasiPT' => $request->lokasi_pt, 
                
                // Data alat
                'namaAlat' => $request->nama_alat,
                'brandAlat' => $request->merek,
                'kodeAlat' => $request->kode_alat,
                'typeAlat' => $request->type_alat,
                'NoSeri' => $request->no_seri,
                'kapasitas' => $request->kapasitas,
                'resolusi' => $request->resolusi,
                'rangeMin' => $request->rentang_ukur_min,
                'rangeMax' => $request->rentang_ukur_max,
                'type' => $request->type, // ⬅️ TAMBAHAN
                'pemilikAlat' => $request->nama_pemilik,
                
                // Tanggal
                'tanggalMasuk' => $request->tanggal_alat_masuk,
                'tanggalKalibrasi' => $request->tanggal_kalibrasi,
                'tempatKalibrasi' => $request->tempat_kalibrasi,
                
                // Kondisi alat
                'kondisiAlat' => $request->fungsi_komponen,
                'keterangan' => $request->keterangan_fungsi_komponen,
    
                // Status awal
                'status' => $initialStatus,
                
                // Kondisi kalibrasi
                'RT_condition1' => $request->suhu_awal,
                'RT_condition2' => $request->suhu_tengah,
                'RT_condition3' => $request->suhu_akhir,
                
                'RH_condition1' => $request->rh_awal,
                'RH_condition2' => $request->rh_tengah,
                'RH_condition3' => $request->rh_akhir,
                
                // TTD
                'calibratedBy' => $request->calibrated_by,
                'verifiedBy' => $request->verified_by,
            ];
    
            // Setelah $calibrationData, sebelum create
            $calibrationData = $this->autoCompleteRequiredColumns($calibrationData);
    
            \Log::info('📦 Calibration data before create:', $calibrationData);
    
            // 1. Simpan ke Calibration
            $calibration = Calibration::create($calibrationData);
            
            // ✅ SESUAI MODEL: Gunakan method markAsWaitingVerification dari model
            $calibration->markAsWaitingVerification($userName);
            
            \Log::info('✅ Calibration saved - ID: ' . $calibration->id);
    
            // 2. Simpan data spesifik alat
            $this->storeAlatSpecificData($request, $calibration, $certificateId, $formType);
    
            \Log::info('🎉 ALL DATA SAVED SUCCESSFULLY');
    
            $successMessage = 'Kalibrasi ' . $request->nama_alat . ' berhasil disimpan! Certificate ID: ' . $certificateId;
    
            return redirect()->route('calibrations.index')->with('success', $successMessage);
    
        } catch (\Exception $e) {
            \Log::error('💥 STORE METHOD ERROR:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function getLkCodeByFormType($formType)
    {
        $lkMapping = [
            'inside_micrometer' => 'PAS-FLK-01',
            'outside_micrometer' => 'PAS-FLK-02', 
            'vernier_caliper' => 'PAS-FLK-03',
            'dial_indicator' => 'PAS-FLK-04',
            'height_gauge' => 'PAS-FLK-05',
            'depth_micrometer' => 'PAS-FLK-06',
            'dial_test_indicator' => 'PAS-FLK-07',
            'caliper_digital' => 'PAS-FLK-08',
            'gauge_block' => 'PAS-FLK-09',
            'surface_plate' => 'PAS-FLK-10',
            'thermometer' => 'PAS-FLK-30',
            'depth_caliper' => 'PAS-FLK-11',
            'caliper' => 'PAS-FLK-03',
            'torque_wrench' => 'PAS-FLK-13',
            'torque_meter' => 'PAS-FLK-13B',
            'ultrasonic_thickness_gauge' => 'PAS-FLK-59',
            'thickness_gauge' => 'PAS-FLK-21',
            'penggaris' => 'PAS-FLK-28',
            'enclosure' => 'PAS-FLK-29',
            'chamber' => 'PAS-FLK-29B',
            'pressure_gauge' => 'PAS-FLK-17',
            'differential_pressure_gauge' => 'PAS-FLK-17B',
            'volumetrik' => 'PAS-FLK-38',
            'thermohygrometer' => 'PAS-FLK-50',
            'viscometer' => 'PAS-FLK-43',
            'push_pull' => 'PAS-FLK-34',
            'timbangan' => 'PAS-FLK-15',
            'timbangan_moisture' => 'PAS-FLK-15',
            'timbangan_bias' => 'PAS-FLK-15B',
            'gauge_block' => 'PAS-FLK-65',
            'holetest' => 'PAS-FLK-49',
            'conductivity meter' => 'PAS-FLK-41',
            'coating thickness' => 'PAS-FLK-46',
            'durometer' => 'PAS-FLK-56',
            'mikropipet_dispenset' => 'PAS-FLK-39',
            'taper_gauge' => 'PAS-FLK-57',
            'feeler_gauge' => 'PAS-FLK-62',
            'ph_meter' => 'PAS-FLK-40',
            'tachometer' => 'PAS-FLK-48',
            'pin_gauge' => 'PAS-FLK-19',
            'visco_cup' => 'PAS-FLK-43B',
            'plain_limit_gauge' => 'PAS-FLK-63',
            'thermo_indicator' => 'PAS-FLK-37',
            'temp_transmitter' => 'PAS-FLK-66',
            'temp_humid_transmitter' => 'PAS-FLK-67',
            'ir_thermometer' => 'PAS-FLK-47',
            'thermoindicator' => 'PAS-FLK-37',
            'plastic_shim' => 'PAS-FLK-60',
            'profil_projector' => 'PAS-FLK-42',
            'surface_roughness_tester' => 'PAS-FLK-61',
            'thread_gauge' => 'PAS-FLK-64',
            'stopwatch' => 'PAS-FLK-45',
            'centrifuge' => 'PAS-FLK-52',
            'utm' => 'PAS-FLK-54',
            'anak_timbangan' => 'PAS-FLK-16',
            'pressure_transmitter' => 'PAS-FLK-55',
            'surface_plate' => 'PAS-FLK-53',
           
         

            


            // Tambahkan alat lainnya
        ];

        $lkCode = $lkMapping[$formType] ?? 'PAS-FLK-00';
        \Log::info("✅ LK Code for {$formType}: {$lkCode}");
        
        return $lkCode;
    }

    private function storeAlatSpecificData($request, $calibration, $certificateId, $formType)
    {
        \Log::info('🔧 Detected form type:', ['type' => $formType]);
        
        switch($formType) {
            case 'inside_micrometer':
                \Log::info('📏 Storing Inside Micrometer data...');
                $this->storeInsideMicrometer($request, $calibration, $certificateId);
                break;
            
            case 'outside_micrometer':
                \Log::info('📐 Storing Outside Micrometer data...');
                $this->storeOutsideMicrometer($request, $calibration, $certificateId);
                break;

            case 'depth_micrometer':
                \Log::info('📐 Storing Depth Micrometer data...');
                $this->storeDepthMicrometer($request, $calibration, $certificateId);
                break;

            case 'thermometer':
                \Log::info('📐 Storing thermometer data...');
                $this->storeThermometer($request, $calibration, $certificateId);
                break;

            case 'dial_indicator':
                    \Log::info('📐 Storing dial_indicator data...');
                    $this->storeDialIndicator($request, $calibration, $certificateId);
                    break;

            case 'dial_test_indicator':
                    \Log::info('📐 Storing dial_test_indicator data...');
                    $this->storeDialTestIndicator($request, $calibration, $certificateId);
                    break;

            case 'depth_caliper':
                \Log::info('📐 Storing depth_caliper data...');
                $this->storeDepthCaliper($request, $calibration, $certificateId);
                break;
                    
            case 'caliper':
                \Log::info('📐 Storing Caliper data...');
                $this->storeCaliper($request, $calibration, $certificateId);
                break;

            case 'torque_wrench':
                \Log::info('📐 Storing Torque Wrench data...');
                $this->storeTorqueWrench($request, $calibration, $certificateId);
                break;

            case 'torque_meter':
                \Log::info('📐 Storing Torque meter data...');
                $this->storeTorqueMeter($request, $calibration, $certificateId);
                break;

            case 'thickness_gauge':
                \Log::info('📐 Storing Thickness gauge data...');
                $this->storeThicknessGauge($request, $calibration, $certificateId);
                break;

            case 'penggaris':
                \Log::info('📐 Storing Penggaris data...');
                $this->storePenggaris($request, $calibration, $certificateId);
                break;

            case 'enclosure':
                \Log::info('📐 Storing enclosure data...');
                $this->storeEnclosure($request, $calibration, $certificateId);
                break;

            case 'chamber':
                \Log::info('📐 Storing CLIMATIC CHAMBER data...');
                $this->storeClimaticChamber($request, $calibration, $certificateId);
                break;

              case 'pressure_gauge':
                \Log::info('📐 Storing Pressure Gauge data...');
                $this->storePressureGauge($request, $calibration, $certificateId);
                break;

            case 'differential_pressure_gauge':
                \Log::info('📐 Storing Differential Pressure Gauge data...');
                $this->storeDifferentialPressureGauge($request, $calibration, $certificateId);
                break;

            case 'volumetrik':
                \Log::info('📐 Storing Volumetrik data...');
                $this->storeVolumetrik($request, $calibration, $certificateId);
                break;

            case 'thermohygrometer':
                \Log::info('📐 Storing Thermohygrometer data...');
                $this->storeThermohygrometer($request, $calibration, $certificateId);
                break;

            case 'viscometer':
                \Log::info('📐 Storing Viscometer data...');
                $this->storeViscometer($request, $calibration, $certificateId);
                break;

            case 'push_pull':
                \Log::info('📐 Storing Push Pull data...');
                $this->storePushPull($request, $calibration, $certificateId);
                break;

            case 'timbangan':
                \Log::info('📐 Storing Timbangan data...');
                $this->storeTimbangan($request, $calibration, $certificateId);
                break;

            case 'timbangan_moisture':
                \Log::info('📐 Storing Timbangan Moisture data...');
                $this->storeTimbanganMoisture($request, $calibration, $certificateId);
                break;

            case 'timbangan_bias':
                \Log::info('📐 Storing Timbangan Bias data...');
                $this->storeTimbanganBias($request, $calibration, $certificateId);
                break;

            case 'gauge_block':
                \Log::info('📐 Storing Gauge Block data...');
                $this->storeGaugeBlock($request, $calibration, $certificateId);
                break;

            case 'holetest':
                \Log::info('📐 Storing HoleTest data...');
                $this->storeHoleTest($request, $calibration, $certificateId);
                break;

            case 'conductivity_meter':
                \Log::info('📐 Storing Conductivity Meter data...');
                $this->storeConductivityMeter($request, $calibration, $certificateId);
                break;

            case 'coating_thickness':
                \Log::info('📐 Storing Coating Thickness data...');
                $this->storeCoatingThickness($request, $calibration, $certificateId);
                break;

            case 'durometer':
                \Log::info('📐 Storing Durometer data...');
                $this->storeDurometer($request, $calibration, $certificateId);
                break;

            case 'mikropipet_dispenset':
                \Log::info('📐 Storing Mikropipet Dispenset data...');
                $this->storeMikropipetDispenset($request, $calibration, $certificateId);
                break;

            case 'taper_gauge':
                \Log::info('📐 Storing Taper Gauge data...');
                $this->storeTaperGauge($request, $calibration, $certificateId);
                break;

            case 'feeler_gauge':
                \Log::info('📐 Storing Feeler Gauge data...');
                $this->storeFeelerGauge($request, $calibration, $certificateId);
                break;

            case 'ph_meter':
                \Log::info('📐 Storing PH Meter data...');
                $this->storePHMeter($request, $calibration, $certificateId);
                break;
                                
            case 'tachometer':
                \Log::info('📐 Storing Tachometer data...');
                $this->storeTachometer($request, $calibration, $certificateId);
                break;

            case 'pin_gauge':
                \Log::info('📐 Storing Pin Gauge data...');
                $this->storePinGauge($request, $calibration, $certificateId);
                break;

            case 'visco_cup':
                \Log::info('📐 Storing Visco Cup data...');
                $this->storeViscoCup($request, $calibration, $certificateId);
                break;

            case 'plain_limit_gauge':
                \Log::info('📐 Storing Plain Limit Gauge data...');
                $this->storePlainLimitGauge($request, $calibration, $certificateId);
                break;

            case 'temp_humid_transmitter':
                \Log::info('📐 Storing temp_humid_transmitter data...');
                $this->storeTempHumidTransmitter($request, $calibration, $certificateId);
                break;
                 
            case 'temp_transmitter':
                \Log::info('📐 Storing temp_transmitter data...');
                $this->storeTempTransmitter($request, $calibration, $certificateId);
                break;

            case 'ir_thermometer':
                \Log::info('📐 Storing ir_thermometer data...');
                $this->storeIrThermometer($request, $calibration, $certificateId);
                break;

            case 'thermoindicator':
                \Log::info('📐 Storing thermoindicator data...');
                $this->storeThermoIndicator($request, $calibration, $certificateId);
                break;

            case 'plastic_shim':
                \Log::info('📐 Storing plastic_shim data...');
                $this->storePlasticShim($request, $calibration, $certificateId);
                break;

            case 'profil_projector':
                \Log::info('📐 Storing profil_projector data...');
                $this->storeProfilProjector($request, $calibration, $certificateId);
                break;

            case 'surface_roughness_tester':
                \Log::info('📐 Storing surface_roughness_tester data...');
                $this->storeSurfaceRoughnessTester($request, $calibration, $certificateId);
                break;

            case 'ultrasonic_thickness_gauge':
                \Log::info('📐 Storing ultrasonic_thickness_gauge data...');
                $this->storeUltrasonicThicknessGauge($request, $calibration, $certificateId);
                break;

            case 'thread_gauge':
                \Log::info('📐 Storing thread_gauge data...');
                $this->storeThreadGauge($request, $calibration, $certificateId);
                break;
                     
            case 'stopwatch':
                \Log::info('📐 Storing stopwatch data...');
                $this->storeStopwatch($request, $calibration, $certificateId);
                break;   
                              
            case 'centrifuge':
                \Log::info('📐 Storing centrifuge data...');
                $this->storeCentrifuge($request, $calibration, $certificateId);
                break;   

            case 'utm':
                \Log::info('📐 Storing UTM data...');
                $this->storeUtm($request, $calibration, $certificateId);
                break;  
                        
            case 'anak_timbangan':
                \Log::info('📐 Storing anak_timbangan data...');
                $this->storeAnakTimbangan($request, $calibration, $certificateId);
                break;  

            case 'pressure_transmitter':
                \Log::info('📐 Storing pressure_transmitter data...');
                $this->storePressureTransmitter($request, $calibration, $certificateId);
                break;       
                
            case 'surface_plate':
                \Log::info('📐 Storing surface_plate data...');
                $this->storeSurfacePlate($request, $calibration, $certificateId);
                break;    
                    
                
            default:
                \Log::error('❌ Unknown form type:', ['type' => $formType]);
                throw new \Exception('Jenis alat tidak dikenali: ' . $formType);
        }
    }

    private function storeInsideMicrometer($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head Inside Micrometer
        $head = HeadInsideMicrometer::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
        ]);

        \Log::info('✅ Head Inside Micrometer saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - SEKARANG 14 BARIS
        \Log::info('📊 Saving detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 14; $i++) { // UBAH DARI 11 MENJADI 14
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada penunjukan yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("penunjukan_{$i}_{$j}") && !empty(trim($request->{"penunjukan_{$i}_{$j}"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data nominal atau penunjukan
            if (($request->has("nominal_$i") && !empty(trim($request->{"nominal_$i"}))) || $hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $request->{"nominal_$i"} ?? '',
                    'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                    'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                    'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                    'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                    'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                ];

                \Log::info("📝 Saving detail row $i:", $detailData);
                
                DetailInsideMicrometer::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Inside Micrometer data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

    private function storeOutsideMicrometer($request, $calibration, $certificateId)
    {
        try {
            $alatStandar = $request->alat_standar ?? [];
            $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
            
            \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandar]);
    
            // Simpan ke Head Outside Micrometer
            $head = HeadOutsideMicrometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $certificateId,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
    
            \Log::info('✅ Head Outside Micrometer saved:', ['head_id' => $head->id]);
    
            // Simpan detail measurements - IKUTI INSIDE: langsung ke calibration_id
            \Log::info('📊 Saving detail measurements...');
            $detailCount = 0;
            
            for ($i = 1; $i <= 11; $i++) {
                if ($request->has("nominal_$i") && !empty($request->{"nominal_$i"})) {
                    
                    $detailData = [
                        'calibration_id' => $calibration->id, // ✅ IKUTI INSIDE
                        'titikUkur' => $request->{"nominal_$i"},
                        'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                        'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                        'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                        'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                        'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                    ];
    
                    \Log::info("📝 Saving detail row $i:", $detailData);
                    
                    DetailOutsideMicrometer::create($detailData);
                    $detailCount++;
                }
            }
            
            \Log::info("✅ Saved $detailCount detail measurements");
    
            // Simpan data Uji Kerataan (Add Outside Micrometer)
            $this->storeUjiKerataan($request, $calibration);
    
        } catch (\Exception $e) {
            \Log::error('💥 Error storing Outside Micrometer data:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

    private function storeUjiKerataan($request, $calibration)
    {
        try {
            \Log::info('🔍 Storing Uji Kerataan data...');
            
            $ujiKerataanData = [
                'calibration_id' => $calibration->id,
                'ukuranAnvil1' => $request->ukuranAnvil1,
                'jumlahAnvil1' => $request->jumlahAnvil1,
                'ukuranAnvil2' => $request->ukuranAnvil2,
                'jumlahAnvil2' => $request->jumlahAnvil2,
                'ukuranSpindle1' => $request->ukuranSpindle1,
                'jumlahSpindle1' => $request->jumlahSpindle1,
                'ukuranSpindle2' => $request->ukuranSpindle2,
                'jumlahSpindle2' => $request->jumlahSpindle2,
            ];

            \Log::info('📝 Uji Kerataan data:', $ujiKerataanData);
            
            AddOutsideMicrometer::create($ujiKerataanData);
            
            \Log::info('✅ Uji Kerataan data saved successfully');
            
        } catch (\Exception $e) {
            \Log::error('💥 Error storing Uji Kerataan data:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

      
    private function storeDepthMicrometer($request, $calibration, $certificateId)
    {
        try {
            $alatStandar = $request->alat_standar ?? [];
            $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
            
            \Log::info('🔧 Alat standar selected for Depth Micrometer:', ['alat_standar' => $alatStandar]);

            // Simpan ke Head Depth Micrometer
            $head = HeadDepthMicrometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $certificateId,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-06 (JIS B 7544 : 1994)',
            ]);

            \Log::info('✅ Head Depth Micrometer saved:', ['head_id' => $head->id]);

            // Simpan detail measurements
            \Log::info('📊 Saving Depth Micrometer detail measurements...');
            $detailCount = 0;
            
            for ($i = 1; $i <= 11; $i++) {
                if ($request->has("nominal_$i") && !empty($request->{"nominal_$i"})) {
                    
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $request->{"nominal_$i"},
                        'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                        'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                        'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                        'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                        'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                    ];

                    \Log::info("📝 Saving Depth Micrometer detail row $i:", $detailData);
                    
                    DetailDepthMicrometer::create($detailData);
                    $detailCount++;
                }
            }
            
            \Log::info("✅ Saved $detailCount detail measurements for Depth Micrometer");

        } catch (\Exception $e) {
            \Log::error('💥 Error storing Depth Micrometer data:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

    /**
     * Update Depth Micrometer data
     */
    private function updateDepthMicrometer($request, $calibration)
{
    \Log::channel('calibration')->info('🚀 ===== START updateDepthMicrometer =====', [
        'calibration_id' => $calibration->id,
        'certificate_id' => $calibration->headDepthMicrometer->certificate_id ?? 'N/A',
        'timestamp' => now()->toDateTimeString()
    ]);
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::channel('calibration')->info('🔧 ALAT STANDAR UPDATE:', [
            'count' => count($alatStandar),
            'items' => $alatStandar,
            'string_value' => $alatStandarString,
            'old_value' => $calibration->headDepthMicrometer->standard ?? 'null'
        ]);

        // Update head data
        if ($head = $calibration->headDepthMicrometer) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
            
            \Log::channel('calibration')->info('✅ HEAD DATA UPDATED:', [
                'head_id' => $head->id,
                'standard_updated' => true,
                'method_updated' => true
            ]);
        } else {
            \Log::channel('calibration')->warning('⚠️ NO HEAD DATA FOUND, creating new...');
            
            $head = HeadDepthMicrometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
            
            \Log::channel('calibration')->info('➕ NEW HEAD CREATED:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL MEASUREMENTS
        // ==================================================================
        \Log::channel('calibration')->info('📊 DETAIL MEASUREMENTS UPDATE:', [
            'old_records_count' => DetailDepthMicrometer::where('calibration_id', $calibration->id)->count(),
            'new_titikUkur_count' => is_array($request->titikUkur) ? count(array_filter($request->titikUkur)) : 0
        ]);
        
        // Log sample of incoming data
        if (is_array($request->titikUkur) && count($request->titikUkur) > 0) {
            \Log::channel('calibration')->debug('📝 INCOMING DATA SAMPLE (first 3 rows):', [
                'row_1' => [
                    'titikUkur' => $request->titikUkur[0] ?? null,
                    'ulangan01' => $request->ulangan01[0] ?? null,
                    'ulangan02' => $request->ulangan02[0] ?? null,
                ],
                'row_2' => [
                    'titikUkur' => $request->titikUkur[1] ?? null,
                    'ulangan01' => $request->ulangan01[1] ?? null,
                    'ulangan02' => $request->ulangan02[1] ?? null,
                ],
                'row_3' => [
                    'titikUkur' => $request->titikUkur[2] ?? null,
                    'ulangan01' => $request->ulangan01[2] ?? null,
                    'ulangan02' => $request->ulangan02[2] ?? null,
                ]
            ]);
        }
        
        // Hapus data detail lama
        $deletedCount = DetailDepthMicrometer::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD DATA DELETED:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru - 14 BARIS
        $detailCount = 0;
        $errors = [];
        
        for ($i = 0; $i < 14; $i++) {
            $titikUkur = $request->titikUkur[$i] ?? null;
            $ulangan01 = $request->ulangan01[$i] ?? null;
            $ulangan02 = $request->ulangan02[$i] ?? null;
            $ulangan03 = $request->ulangan03[$i] ?? null;
            $ulangan04 = $request->ulangan04[$i] ?? null;
            $ulangan05 = $request->ulangan05[$i] ?? null;
            
            // Check if row has data
            $hasData = !empty(trim($titikUkur ?? '')) || 
                      !empty(trim($ulangan01 ?? '')) || 
                      !empty(trim($ulangan02 ?? '')) || 
                      !empty(trim($ulangan03 ?? '')) || 
                      !empty(trim($ulangan04 ?? '')) || 
                      !empty(trim($ulangan05 ?? ''));
            
            if ($hasData) {
                try {
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $titikUkur,
                        'ulangan01' => $this->formatNumericValue($ulangan01),
                        'ulangan02' => $this->formatNumericValue($ulangan02),
                        'ulangan03' => $this->formatNumericValue($ulangan03),
                        'ulangan04' => $this->formatNumericValue($ulangan04),
                        'ulangan05' => $this->formatNumericValue($ulangan05),
                    ];
                    
                    \Log::channel('calibration')->debug("💾 SAVING ROW {$i}:", [
                        'row' => $i,
                        'data' => $detailData
                    ]);
                    
                    DetailDepthMicrometer::create($detailData);
                    $detailCount++;
                    
                } catch (\Exception $rowError) {
                    $errors[] = "Row {$i}: " . $rowError->getMessage();
                    \Log::channel('calibration')->error("❌ ROW {$i} SAVE ERROR:", [
                        'error' => $rowError->getMessage(),
                        'data' => compact('titikUkur', 'ulangan01', 'ulangan02')
                    ]);
                }
            } else {
                \Log::channel('calibration')->debug("⏭️ SKIPPING EMPTY ROW {$i}");
            }
        }
        
        \Log::channel('calibration')->info("✅ DETAIL DATA SAVED:", [
            'total_records' => $detailCount,
            'errors_count' => count($errors),
            'errors' => $errors
        ]);

        // ==================================================================
        // 3. VERIFY SAVED DATA
        // ==================================================================
        $savedDetails = DetailDepthMicrometer::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::channel('calibration')->info('🔍 VERIFY SAVED DATA:', [
            'total_saved' => $savedDetails->count(),
            'first_3_rows_sample' => $savedDetails->take(3)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkur' => $item->titikUkur,
                    'ulangan01' => $item->ulangan01,
                    'ulangan02' => $item->ulangan02,
                    'created_at' => $item->created_at
                ];
            })->toArray()
        ]);

        // ==================================================================
        // 4. UPDATE CALIBRATION ADDITIONAL DATA
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibratedBy')) {
            $updateData['calibrated_by'] = $request->calibratedBy;
        }
        
        if ($request->filled('verifiedBy')) {
            $updateData['verified_by'] = $request->verifiedBy;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::channel('calibration')->info('📝 CALIBRATION ADDITIONAL DATA UPDATED:', $updateData);
        }

        // ==================================================================
        // 5. FINAL SUMMARY
        // ==================================================================
        $finalDetailCount = DetailDepthMicrometer::where('calibration_id', $calibration->id)->count();
        
        \Log::channel('calibration')->info('📋 UPDATE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'certificate_id' => $head->certificate_id ?? 'N/A',
            'detail_records' => $finalDetailCount,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by,
            'verified_by' => $calibration->verified_by,
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_peak' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);

        \Log::channel('calibration')->info('🎉 updateDepthMicrometer COMPLETED SUCCESSFULLY');
        return true;

    } catch (\Exception $e) {
        \Log::channel('calibration')->error('💥 updateDepthMicrometer FAILED:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}


        private function storeThermometer($request, $calibration, $certificateId)
    {
        try {
            $alatStandar = $request->alat_standar ?? [];
            $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
            
            $jenisAlat = $request->jenis_alat ?? [];
            $jenisAlatString = !empty($jenisAlat) ? implode(', ', $jenisAlat) : '';
            
            $metodeKalibrasi = $request->metode_kalibrasi ?? [];
            $metodeKalibrasiString = !empty($metodeKalibrasi) ? implode(', ', $metodeKalibrasi) : '';

            \Log::info('🔧 Alat standar selected for Thermometer:', ['alat_standar' => $alatStandar]);
            \Log::info('🔧 Jenis alat selected for Thermometer:', ['jenis_alat' => $jenisAlat]);
            \Log::info('🔧 Metode kalibrasi selected for Thermometer:', ['metode_kalibrasi' => $metodeKalibrasi]);
            \Log::info('🔧 Satuan suhu kiri:', ['satuan_suhu' => $request->satuan_suhu]);
            \Log::info('🔧 Satuan suhu kanan:', ['satuan_suhu_kanan' => $request->satuan_suhu_kanan]);

            // Simpan ke Head Thermometer (tanpa satuan)
            $head = HeadThermometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $certificateId,
                'standard' => $alatStandarString,
                'calibrationMethod' => $metodeKalibrasiString,
                'satuan_suhu_kiri' => $request->satuan_suhu_kiri ?? null,
                'satuan_suhu_kanan' => $request->satuan_suhu_kanan ?? null,
                
            ]);

            \Log::info('✅ Head Thermometer saved:', ['head_id' => $head->id]);

            // Simpan detail measurements untuk semua data (36 baris total)
            \Log::info('📊 Saving Thermometer detail measurements...');
            $detailCount = 0;
            
            // Simpan setting suhu sebagai titikUkur untuk semua 36 baris
            $settingSuhu = $request->setting_suhu ?? [];
            
            // Ambil satuan dari input form
            $satuanKiri = $request->satuan_suhu ?? '';
            $satuanKanan = $request->satuan_suhu_kanan ?? $satuanKiri; // Default ke satuan kiri jika kanan kosong
            
            // Proses setiap kelompok 3 baris (total 12 kelompok untuk 36 baris)
            for ($group = 0; $group < 12; $group++) {
                $baseIndex = ($group * 3) + 1; // 1, 4, 7, 10, ..., 34
                
                // Cek apakah ada setting suhu untuk kelompok ini
                if (isset($settingSuhu[$group]) && !empty($settingSuhu[$group])) {
                    
                    // Tentukan satuan berdasarkan posisi (kiri: 1-18, kanan: 19-36)
                    $satuan = ($baseIndex <= 18) ? $satuanKiri : $satuanKanan;
                    
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $settingSuhu[$group], // ✅ setting_suhu[] sebagai titikUkur
                        'STD01' => $request->{"std_{$baseIndex}"} ?? null,
                        'STD02' => $request->{"std_" . ($baseIndex + 1)} ?? null,
                        'STD03' => $request->{"std_" . ($baseIndex + 2)} ?? null,
                        'UUT01' => $request->{"uut_{$baseIndex}"} ?? null,
                        'UUT02' => $request->{"uut_" . ($baseIndex + 1)} ?? null,
                        'UUT03' => $request->{"uut_" . ($baseIndex + 2)} ?? null,
                    ];

                    \Log::info("📝 Saving Thermometer detail group " . ($group + 1) . " (rows $baseIndex-" . ($baseIndex + 2) . ") ", $detailData);
                    
                    DetailThermometer::create($detailData);
                    $detailCount++;
                }
            }

            \Log::info("✅ Saved {$detailCount} detail measurements for Thermometer");

        } catch (\Exception $e) {
            \Log::error('💥 Error storing Thermometer data:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
    }

    /**
     * Update Thermometer data
     */
private function updateThermometer($request, $calibration)
{
    \Log::info('🚀 ===== START updateThermometer =====', [
        'calibration_id' => $calibration->id,
        'timestamp' => now()->toDateTimeString()
    ]);
    
    \DB::beginTransaction();
    
    try {
        // ==================================================================
        // 1. UPDATE HEAD DATA
        // ==================================================================
        if ($head = $calibration->headThermometer) {
            $head->update([
                'standard' => implode(', ', $request->alat_standar ?? []),
                'calibrationMethod' => implode(', ', $request->metode_kalibrasi ?? []),
                'satuan_suhu_kiri' => $request->satuan_suhu_kiri ?? '',
                'satuan_suhu_kanan' => $request->satuan_suhu_kanan ?? '',
            ]);
        } else {
            $head = \App\Models\HeadThermometer::create([
                'calibration_id' => $calibration->id,
                'standard' => implode(', ', $request->alat_standar ?? []),
                'calibrationMethod' => implode(', ', $request->metode_kalibrasi ?? []),
                'satuan_suhu_kiri' => $request->satuan_suhu_kiri ?? '',
                'satuan_suhu_kanan' => $request->satuan_suhu_kanan ?? '',
            ]);
        }

        // ==================================================================
        // 2. AMBIL DATA DETAIL YANG SUDAH ADA
        // ==================================================================
        // Ambil semua data detail yang sudah ada untuk calibration ini
        $existingDetails = \App\Models\DetailThermometer::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::info('📋 EXISTING DETAILS:', [
            'calibration_id' => $calibration->id,
            'count' => $existingDetails->count(),
            'ids' => $existingDetails->pluck('id')->toArray()
        ]);
        
        // Jika tidak ada data sama sekali, buat 12 record kosong dulu
        if ($existingDetails->count() === 0) {
            \Log::info('📝 NO EXISTING DETAILS, CREATING 12 EMPTY RECORDS');
            for ($i = 0; $i < 12; $i++) {
                \App\Models\DetailThermometer::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => null,
                    'STD01' => null, 'STD02' => null, 'STD03' => null,
                    'UUT01' => null, 'UUT02' => null, 'UUT03' => null,
                ]);
            }
            // Ambil lagi data yang baru dibuat
            $existingDetails = \App\Models\DetailThermometer::where('calibration_id', $calibration->id)
                ->orderBy('id')
                ->get();
        }
        
        // ==================================================================
        // 3. UPDATE DATA DETAIL YANG SUDAH ADA (MAX 12 RECORD)
        // ==================================================================
        $settingSuhu = $request->setting_suhu ?? [];
        $detailIds = $request->detail_ids ?? [];
        
        $updatedCount = 0;
        $totalGroups = min(12, $existingDetails->count()); // Maksimal 12
        
        \Log::info('🔄 UPDATING DETAILS:', [
            'total_groups_to_process' => $totalGroups,
            'setting_suhu_count' => count($settingSuhu),
            'detail_ids_count' => count($detailIds)
        ]);
        
        for ($group = 0; $group < $totalGroups; $group++) {
            $baseIndex = ($group * 3) + 1;
            
            $titikUkur = $settingSuhu[$group] ?? null;
            $std01 = $request->{"std_{$baseIndex}"} ?? null;
            $std02 = $request->{"std_" . ($baseIndex + 1)} ?? null;
            $std03 = $request->{"std_" . ($baseIndex + 2)} ?? null;
            $uut01 = $request->{"uut_{$baseIndex}"} ?? null;
            $uut02 = $request->{"uut_" . ($baseIndex + 1)} ?? null;
            $uut03 = $request->{"uut_" . ($baseIndex + 2)} ?? null;
            
            // Ambil detail yang sudah ada untuk group ini
            $existingDetail = $existingDetails->get($group);
            
            if ($existingDetail) {
                $detailData = [
                    'titikUkur' => $this->cleanValue($titikUkur),
                    'STD01' => $this->formatNumericValue($std01),
                    'STD02' => $this->formatNumericValue($std02),
                    'STD03' => $this->formatNumericValue($std03),
                    'UUT01' => $this->formatNumericValue($uut01),
                    'UUT02' => $this->formatNumericValue($uut02),
                    'UUT03' => $this->formatNumericValue($uut03),
                ];
                
                // Update hanya jika ada perubahan
                $existingDetail->update($detailData);
                $updatedCount++;
                
                \Log::debug("✅ UPDATED GROUP {$group} (ID: {$existingDetail->id})", [
                    'titikUkur' => $detailData['titikUkur'],
                    'has_std01' => !is_null($detailData['STD01'])
                ]);
            } else {
                \Log::warning("⚠️ NO EXISTING DETAIL FOR GROUP {$group}");
            }
        }
        
        // ==================================================================
        // 4. HAPUS DATA LEBIH DARI 12 JIKA ADA (JUST IN CASE)
        // ==================================================================
        $allDetails = \App\Models\DetailThermometer::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        if ($allDetails->count() > 12) {
            $excessDetails = $allDetails->slice(12);
            $excessIds = $excessDetails->pluck('id')->toArray();
            
            \App\Models\DetailThermometer::whereIn('id', $excessIds)->delete();
            
            \Log::info('🗑️ DELETED EXCESS RECORDS:', [
                'deleted_count' => count($excessIds),
                'deleted_ids' => $excessIds
            ]);
        }
        
        \Log::info("📊 UPDATE SUMMARY:", [
            'calibration_id' => $calibration->id,
            'updated_records' => $updatedCount,
            'total_after_update' => \App\Models\DetailThermometer::where('calibration_id', $calibration->id)->count(),
            'expected_total' => 12
        ]);

        // ==================================================================
        // 5. UPDATE CALIBRATION ADDITIONAL DATA
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibratedBy')) {
            $updateData['calibrated_by'] = $request->calibratedBy;
        }
        
        if ($request->filled('verifiedBy')) {
            $updateData['verified_by'] = $request->verifiedBy;
        }
        
        if ($request->filled('conclusion')) {
            $updateData['keterangan'] = $request->conclusion;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 6. VERIFY FINAL DATA
        // ==================================================================
        $finalDetails = \App\Models\DetailThermometer::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::info('🔍 FINAL DATA VERIFICATION:', [
            'total_records' => $finalDetails->count(),
            'should_be' => 12,
            'sample_data' => $finalDetails->take(2)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkur' => $item->titikUkur,
                    'STD01' => $item->STD01,
                    'UUT01' => $item->UUT01,
                ];
            })->toArray()
        ]);

        \DB::commit();
        \Log::info('🎉 updateThermometer COMPLETED SUCCESSFULLY');
        return true;

    } catch (\Exception $e) {
        \DB::rollBack();
        
        \Log::error('💥 updateThermometer FAILED:', [
            'message' => $e->getMessage(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}

// Helper function untuk clean value
private function cleanValue($value)
{
    if (is_null($value) || $value === '' || $value === 'null') {
        return null;
    }
    return $value;
}



    private function storeDialIndicator($request, $calibration, $certificateId)
{
    try {
        \Log::info('START storeDialIndicator');
        
        // ==================================================================
        // DEBUG DETAILED
        // ==================================================================
        \Log::info('📋 ALL REQUEST DATA for dial indicator:', [
            'alat_standar' => $request->alat_standar,
            'alat_standar_tambahan' => $request->alat_standar_tambahan,
            'alat_standar_count' => is_array($request->alat_standar) ? count($request->alat_standar) : 0,
            'skala' => $request->skala,
            'repeability' => $request->repeability,
            'penunjukanAlat_count' => is_array($request->penunjukanAlat) ? count($request->penunjukanAlat) : 0
        ]);

        // ==================================================================
        // 1. AMBIL & SIMPAN SKALA
        // ==================================================================
        $skala = $request->skala;
        if (!$skala || !in_array($skala, ['0.001', '0.01'])) {
            $skala = '0.01';
        }
        $calibration->update(['skala' => $skala]);
        $is001 = $skala === '0.001';
        \Log::info('Skala tersimpan', ['skala' => $skala, 'is001' => $is001]);

        // ==================================================================
        // 2. PROSES ALAT STANDAR - DENGAN FILTER YANG BENAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarTambahan = $request->alat_standar_tambahan ?? '';

        \Log::info('🔧 Processing alat standar:', [
            'alatStandar_raw' => $alatStandar,
            'alatStandarTambahan' => $alatStandarTambahan
        ]);

        $standardParts = [];
        
        if (is_array($alatStandar)) {
            foreach ($alatStandar as $index => $alat) {
                \Log::info("   - Item {$index}: '{$alat}' (length: " . strlen($alat) . ")");
                
                // FILTER 1: Skip jika kosong atau hanya whitespace
                if (trim($alat) === '') {
                    \Log::info("     -> SKIP: Empty string");
                    continue;
                }
                
                // FILTER 2: Untuk 'alat_standar_lainnya', gunakan value dari input tambahan
                if ($alat === 'alat_standar_lainnya') {
                    if (!empty(trim($alatStandarTambahan))) {
                        \Log::info("     -> ADD: 'alat_standar_lainnya' -> '{$alatStandarTambahan}'");
                        $standardParts[] = trim($alatStandarTambahan);
                    } else {
                        \Log::info("     -> SKIP: 'alat_standar_lainnya' but alat_standar_tambahan is empty");
                    }
                } 
                // FILTER 3: Untuk value lainnya, langsung tambahkan
                else {
                    \Log::info("     -> ADD: '{$alat}'");
                    $standardParts[] = trim($alat);
                }
            }
        }
        
        // FILTER 4: Jika ada input tambahan yang belum masuk
        if (!empty(trim($alatStandarTambahan))) {
            $alreadyExists = false;
            foreach ($standardParts as $part) {
                if ($part === trim($alatStandarTambahan)) {
                    $alreadyExists = true;
                    break;
                }
            }
            if (!$alreadyExists) {
                \Log::info("   - Adding alat_standar_tambahan yang belum terdaftar: '{$alatStandarTambahan}'");
                $standardParts[] = trim($alatStandarTambahan);
            }
        }

        // Pastikan tidak ada duplikat
        $standardParts = array_unique($standardParts);
        $standardValue = !empty($standardParts) ? implode(', ', $standardParts) : 'Tidak ada alat standar';
        
        \Log::info('📝 Standard value final:', ['standardValue' => $standardValue]);

        HeadDialIndicator::create([
            'calibration_id'    => $calibration->id,
            'certificate_id'    => $certificateId,
            'standard'          => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-03 (JIS B 7503:2017 (JMA/JSA); SNSU PK.P-03:2020).',
        ]);

        \Log::info('✅ HeadDialIndicator created');

        // ==================================================================
        // 3. SIMPAN REPEATABILITY
        // ==================================================================
        AddDialIndicator::create([
            'calibration_id' => $calibration->id,
            'repeatability'    => $request->repeatability ?? null,
            'ulangan01'      => $request->ulangan01 ?? null,
            'ulangan02'      => $request->ulangan02 ?? null,
            'ulangan03'      => $request->ulangan03 ?? null,
            'ulangan04'      => $request->ulangan04 ?? null,
            'ulangan05'      => $request->ulangan05 ?? null,
            'ulangan06'      => $request->ulangan06 ?? null,
            'ulangan07'      => $request->ulangan07 ?? null,
            'ulangan08'      => $request->ulangan08 ?? null,
            'ulangan09'      => $request->ulangan09 ?? null,
            'ulangan10'      => $request->ulangan10 ?? null,
        ]);

        \Log::info('✅ AddDialIndicator created');

        // ==================================================================
        // 4. SIMPAN DETAIL KALIBRASI
        // ==================================================================
        $penunjukanAlat = $request->penunjukanAlat ?? [];
        $pembacaanNaik  = $request->pembacaanNaik ?? [];
        $pembacaanTurun = $request->pembacaanTurun ?? [];

        \Log::info('📊 Jumlah baris diterima', [
            'penunjukanAlat' => count($penunjukanAlat),
            'pembacaanNaik'  => count($pembacaanNaik),
            'pembacaanTurun' => count($pembacaanTurun),
        ]);

        $detailCount = 0;
        $savedDetails = [];

        foreach ($penunjukanAlat as $i => $titikRaw) {
            $titik = trim($titikRaw ?? '');
            $naik = $pembacaanNaik[$i] ?? '';
            $turun = $pembacaanTurun[$i] ?? '';
            
            // Skip jika semua kolom kosong
            if ($titik === '' && $naik === '' && $turun === '') {
                continue;
            }
        
            $detail = DetailDialIndicator::create([
                'calibration_id' => $calibration->id,
                'titikUkur'      => $titik !== '' ? $titik : null,
                'ulanganNaik'    => $naik !== '' ? $naik : null,
                'ulanganTurun'   => $turun !== '' ? $turun : null,
            ]);
            
            $detailCount++;
            $savedDetails[] = [
                'titik' => $titik,
                'naik' => $naik,
                'turun' => $turun
            ];
        }

        \Log::info('✅ DetailDialIndicator berhasil disimpan', [
            'total_records' => $detailCount,
            'skala'         => $skala,
            'first_5_records' => array_slice($savedDetails, 0, 5)
        ]);

        \Log::info('🎯 storeDialIndicator SELESAI');

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeDialIndicator', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'trace'   => $e->getTraceAsString()
        ]);
        throw $e;
    }
}


private function updateDialIndicator($request, $calibration)
{
    \Log::info('🚀 START updateDialIndicator');
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR (HEAD DIAL INDICATOR)
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = '';
        
        \Log::info('🔧 Update data:', [
            'alat_standar' => $alatStandar,
            'alat_standar_tambahan' => $request->alat_standar_tambahan
        ]);
        
        // Process alat standar
        $processedAlat = [];
        foreach ($alatStandar as $alat) {
            if ($alat === 'dial_gauge_tester_0_25mm') {
                $processedAlat[] = 'Dial Gauge Tester 0~25 mm';
            } 
            elseif ($alat === 'dial_calibration_tester_0_1mm') {
                $processedAlat[] = 'Dial Calibration Tester 0~1 mm';
            }
            elseif ($alat === 'electronic_gauge_tester_0_50mm') {
                $processedAlat[] = 'Electronic Gauge Tester 0~50 mm';
            }
            elseif ($alat === 'alat_standar_lainnya' && $request->filled('alat_standar_tambahan')) {
                $processedAlat[] = $request->alat_standar_tambahan;
            }
        }
        
        $alatStandarString = !empty($processedAlat) ? implode(', ', $processedAlat) : '';
        
        // Update atau create HEAD DIAL INDICATOR
        if ($head = $calibration->headDialIndicator) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-03 (JIS B 7503:2017 (JMA/JSA); SNSU PK.P-03:2020)',
            ]);
            
            \Log::info('✅ HeadDialIndicator updated:', ['standard' => $alatStandarString]);
        } else {
            // Create new if doesn't exist
            $head = HeadDialIndicator::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-03 (JIS B 7503:2017 (JMA/JSA); SNSU PK.P-03:2020)',
            ]);
            
            \Log::info('➕ NEW HeadDialIndicator created:', ['head_id' => $head->id]);
        }
        
        // ==================================================================
        // 2. UPDATE ADD DIAL INDICATOR (untuk repeatability dan ulangan 01-10)
        // ==================================================================
        // Cek apakah AddDialIndicator sudah ada
        if ($add = $calibration->addDialIndicator) {
            // Update existing
            $updateData = [];
            
            // Update repeatability jika ada
           if ($request->filled('repeatability')) {
                $repeatValue = $this->formatRepeatability($request->repeatability);
                if (!is_null($repeatValue)) {
                    $updateData['repeatability'] = $repeatValue;
                    \Log::info('✅ Repeatability formatted:', [
                        'original' => $request->repeatability,
                        'formatted' => $repeatValue
                    ]);
                }
            
            // Update ulangan 01-10 jika ada
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = ($i < 10) ? 'ulangan0' . $i : 'ulangan' . $i;
                if ($request->filled($fieldName)) {
                    $updateData[$fieldName] = $this->formatNumericValue($request->$fieldName);
                    \Log::debug("📝 {$fieldName} to update:", ['value' => $updateData[$fieldName]]);
                }
            }
            
            // Update jika ada data
            if (!empty($updateData)) {
                $add->update($updateData);
                \Log::info('✅ AddDialIndicator updated. Fields:', array_keys($updateData));
            } else {
                \Log::info('ℹ️ No data to update in AddDialIndicator');
            }
            
        } else {
            // Create new AddDialIndicator jika belum ada
            $addData = [
                'calibration_id' => $calibration->id,
            ];
            
            // Tambahkan repeatability jika ada
            if ($request->filled('repeatability')) {
                $addData['repeatability'] = $this->formatNumericValue($request->repeatability);
                \Log::info('📝 Repeatability to create:', ['value' => $addData['repeatability']]);
            }
            
            // Tambahkan ulangan 01-10 jika ada
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = ($i < 10) ? 'ulangan0' . $i : 'ulangan' . $i;
                if ($request->filled($fieldName)) {
                    $addData[$fieldName] = $this->formatNumericValue($request->$fieldName);
                    \Log::debug("📝 {$fieldName} to create:", ['value' => $addData[$fieldName]]);
                }
            }
            
            // Hanya create jika ada data (tidak hanya calibration_id)
            if (count($addData) > 1) {
                $add = AddDialIndicator::create($addData);
                \Log::info('➕ NEW AddDialIndicator created:', [
                    'add_id' => $add->id,
                    'fields_saved' => array_keys($addData)
                ]);
            } else {
                \Log::info('ℹ️ No AddDialIndicator data to create');
            }
        }
        
        // ==================================================================
        // 3. UPDATE DETAIL MEASUREMENTS (titikUkur, ulanganNaik, ulanganTurun)
        // ==================================================================
        // Hapus data detail lama
        $deletedCount = DetailDialIndicator::where('calibration_id', $calibration->id)->delete();
        \Log::info('🗑️ Old DetailDialIndicator deleted:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru
        $detailCount = 0;
        
        // Cek apakah data titikUkur ada dan berupa array
        if (is_array($request->titikUkur) && count($request->titikUkur) > 0) {
            // Loop melalui semua titikUkur
            foreach ($request->titikUkur as $index => $titikUkur) {
                // Skip jika null atau empty
                if (is_null($titikUkur) || $titikUkur === '') {
                    continue;
                }
                
                $ulanganNaik = $request->ulanganNaik[$index] ?? null;
                $ulanganTurun = $request->ulanganTurun[$index] ?? null;
                
                // Format nilai
                $formattedTitikUkur = $this->formatNumericValue($titikUkur);
                $formattedNaik = $this->formatNumericValue($ulanganNaik);
                $formattedTurun = $this->formatNumericValue($ulanganTurun);
                
                // Hanya simpan jika ada data
                if (!is_null($formattedTitikUkur) || !is_null($formattedNaik) || !is_null($formattedTurun)) {
                    try {
                        $detailData = [
                            'calibration_id' => $calibration->id,
                            'titikUkur' => $formattedTitikUkur,
                            'ulanganNaik' => $formattedNaik,
                            'ulanganTurun' => $formattedTurun,
                        ];
                        
                        DetailDialIndicator::create($detailData);
                        $detailCount++;
                        
                    } catch (\Exception $rowError) {
                        \Log::error("❌ DetailDialIndicator row {$index} error:", [
                            'error' => $rowError->getMessage(),
                            'data' => $detailData ?? []
                        ]);
                    }
                }
            }
        }
        } else {
            \Log::warning('⚠️ No titikUkur data provided for DetailDialIndicator update');
        }
        
        \Log::info('✅ DetailDialIndicator updated:', ['total_records' => $detailCount]);
        
        \Log::info('🎉 updateDialIndicator completed');
        return true;
        
    } catch (\Exception $e) {
        \Log::error('💥 updateDialIndicator failed:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}

private function formatRepeatability($value)
{
    \Log::debug("🔢 formatRepeatability INPUT:", ['value' => $value, 'type' => gettype($value)]);
    
    if (is_null($value) || $value === '' || $value === 'null') {
        return null;
    }
    
    // Jika ingin simpan STRING APA ADANYA:
    return (string) $value; // Simpan sebagai string
    
    // Atau jika ingin trim:
    // return trim((string) $value);
}

private function storeDialTestIndicator($request, $calibration, $certificateId)
{
    try {
        \Log::info('START storeDialTestIndicator');

        // ==================================================================
        // 1. AMBIL & SIMPAN SKALA (WAJIB!)
        // ==================================================================
        $skala = $request->skala; // '0.001' atau '0.01' dari hidden input
        if (!$skala || !in_array($skala, ['0.001', '0.01'])) {
            $skala = '0.01'; // fallback kalau kosong
        }

        $calibration->update(['skala' => $skala]);
        $is001 = $skala === '0.001';

        \Log::info('Skala tersimpan', ['skala' => $skala, 'is001' => $is001]);

        // ==================================================================
        // 2. PROSES ALAT STANDAR (tetap sama)
        // ==================================================================
        $alatStandar         = $request->alat_standar ?? [];
        $alatStandarTambahan  = $request->alat_standar_tambahan ?? '';

        $standardParts = [];
        foreach ($alatStandar as $alat) {
            if ($alat !== 'alat_standar_lainnya') {
                $standardParts[] = $alat;
            }
        }
        if (!empty($alatStandarTambahan)) {
            $standardParts[] = $alatStandarTambahan;
        }
        $standardValue = implode(', ', $standardParts);

        HeadDialTestIndicator::create([
            'calibration_id'    => $calibration->id,
            'certificate_id'    => $certificateId,
            'standard'          => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-07 (JIS B 7533 : 2015)',
        ]);

        // ==================================================================
        // 3. SIMPAN REPEATABILITY (tetap sama)
        // ==================================================================
        AddDialTestIndicator::create([
            'calibration_id' => $calibration->id,
            'repeatability'    => $request->repeatability ?? null,
            'ulangan01'      => $request->ulangan01 ?? null,
            'ulangan02'      => $request->ulangan02 ?? null,
            'ulangan03'      => $request->ulangan03 ?? null,
            'ulangan04'      => $request->ulangan04 ?? null,
            'ulangan05'      => $request->ulangan05 ?? null,
            'ulangan06'      => $request->ulangan06 ?? null,
            'ulangan07'      => $request->ulangan07 ?? null,
            'ulangan08'      => $request->ulangan08 ?? null,
            'ulangan09'      => $request->ulangan09 ?? null,
            'ulangan10'      => $request->ulangan10 ?? null,
        ]);

        // ==================================================================
        // 4. SIMPAN DETAIL KALIBRASI + FILTER BERDASARKAN SKALA
        // ==================================================================
        $penunjukanAlat = $request->penunjukanAlat ?? [];
        $pembacaanNaik  = $request->pembacaanNaik ?? [];
        $pembacaanTurun = $request->pembacaanTurun ?? [];
        
        \Log::info('📊 Jumlah baris diterima', [
            'penunjukanAlat' => count($penunjukanAlat),
            'pembacaanNaik'  => count($pembacaanNaik),
            'pembacaanTurun' => count($pembacaanTurun),
            'semua_penunjukan' => $penunjukanAlat, // LOG SEMUA DATA
            'semua_pembacaan_naik' => $pembacaanNaik,
            'semua_pembacaan_turun' => $pembacaanTurun,
        ]);

        $detailCount = 0;

            
        foreach ($penunjukanAlat as $i => $titikRaw) {
            $titik = trim($titikRaw ?? '');
            
            // AMBIL DATA PEMBACAAN
            $naik = $pembacaanNaik[$i] ?? '';
            $turun = $pembacaanTurun[$i] ?? '';
            
            // SKIP HANYA JIKA SEMUA KOLOM KOSONG
            if ($titik === '' && $naik === '' && $turun === '') {
                continue;
            }
        
            // SIMPAN SEMUA DATA TANPA FILTER SKALA
            // (Dial Test Indicator mungkin butuh range yang lebih besar)
            DetailDialTestIndicator::create([
                'calibration_id' => $calibration->id,
                'titikUkur'      => $titik !== '' ? $titik : null,
                'ulanganNaik'    => $naik !== '' ? $naik : null,
                'ulanganTurun'   => $turun !== '' ? $turun : null,
            ]);
        
            $detailCount++;
        }
        

        \Log::info('DetailDialTestIndicator berhasil disimpan', [
            'total_records' => $detailCount,
            'skala'         => $skala
        ]);

        \Log::info('storeDialTestIndicator SELESAI');

    } catch (\Exception $e) {
        \Log::error('ERROR storeDialTestIndicator', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
        ]);
        throw $e;
    }
}

private function updateDialTestIndicator($request, $calibration)
{
    \Log::info('🚀 START updateDialTestIndicator');
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR (HEAD DIAL TEST INDICATOR)
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = '';
        
        \Log::info('🔧 Update data:', [
            'alat_standar' => $alatStandar,
            'alat_standar_tambahan' => $request->alat_standar_tambahan ?? ''
        ]);
        
        // Process alat standar (SESUAI DENGAN Dial Indicator)
        $processedAlat = [];
        foreach ($alatStandar as $alat) {
            if ($alat === 'dial_gauge_tester_0_25mm') {
                $processedAlat[] = 'Dial Gauge Tester 0~25 mm';
            } 
            elseif ($alat === 'dial_calibration_tester_0_1mm') {
                $processedAlat[] = 'Dial Calibration Tester 0~1 mm';
            }
            elseif ($alat === 'electronic_gauge_tester_0_50mm') {
                $processedAlat[] = 'Electronic Gauge Tester 0~50 mm';
            }
            elseif ($alat === 'alat_standar_lainnya' && $request->filled('alat_standar_tambahan')) {
                $processedAlat[] = $request->alat_standar_tambahan;
            } else {
                // Untuk alat standar lainnya yang tidak dalam mapping
                $processedAlat[] = $alat;
            }
        }
        
        $alatStandarString = !empty($processedAlat) ? implode(', ', $processedAlat) : '';
        
        // Update atau create HEAD DIAL TEST INDICATOR
        if ($head = $calibration->headDialTestIndicator) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-07 (JIS B 7533 : 2015)',
            ]);
            
            \Log::info('✅ HeadDialTestIndicator updated:', ['standard' => $alatStandarString]);
        } else {
            // Create new if doesn't exist
            $head = HeadDialTestIndicator::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-07 (JIS B 7533 : 2015)',
            ]);
            
            \Log::info('➕ NEW HeadDialTestIndicator created:', ['head_id' => $head->id]);
        }
        
        // ==================================================================
        // 2. DEBUG DATA MASUK
        // ==================================================================
        \Log::info('🔍 DEBUG DATA FROM REQUEST:', [
            'repeatability_exists' => $request->has('repeatability'),
            'repeatability_value' => $request->repeatability,
            'repeability_exists' => $request->has('repeability'),
            'repeability_value' => $request->repeability,
            'ulangan_fields' => [
                'ulangan01' => $request->ulangan01 ?? 'NOT SET',
                'ulangan02' => $request->ulangan02 ?? 'NOT SET',
                'ulangan03' => $request->ulangan03 ?? 'NOT SET',
                'ulangan04' => $request->ulangan04 ?? 'NOT SET',
                'ulangan05' => $request->ulangan05 ?? 'NOT SET',
                'ulangan06' => $request->ulangan06 ?? 'NOT SET',
                'ulangan07' => $request->ulangan07 ?? 'NOT SET',
                'ulangan08' => $request->ulangan08 ?? 'NOT SET',
                'ulangan09' => $request->ulangan09 ?? 'NOT SET',
                'ulangan10' => $request->ulangan10 ?? 'NOT SET',
            ]
        ]);
        
        // ==================================================================
        // 3. UPDATE ADD DIAL TEST INDICATOR (untuk repeatability dan ulangan 01-10)
        // ==================================================================
        // Cek apakah AddDialTestIndicator sudah ada
        if ($add = $calibration->addDialTestIndicator) {
            \Log::info('📋 Existing AddDialTestIndicator found:', ['id' => $add->id]);
            
            $updateData = [];
            
            // 1. HANDLE REPEATABILITY/REPEABILITY (PRIORITAS: repeatability > repeability)
            $repeatField = null;
            $repeatValue = null;
            
            // Cek field mana yang digunakan
            if ($request->filled('repeatability')) {
                $repeatField = 'repeatability';
                $repeatValue = $request->repeatability;
            } elseif ($request->filled('repeability')) {
                $repeatField = 'repeability';
                $repeatValue = $request->repeability;
            }
            
            if ($repeatField && !is_null($repeatValue)) {
                // Format nilai (simpan sebagai string untuk Dial Test Indicator)
                $formattedValue = $this->formatRepeatability($repeatValue);
                $updateData[$repeatField] = $formattedValue;
                
                \Log::info('✅ Repeatability will be updated:', [
                    'field' => $repeatField,
                    'original' => $repeatValue,
                    'formatted' => $formattedValue
                ]);
            } else {
                \Log::info('ℹ️ No repeatability data provided');
            }
            
            // 2. Handle ulangan 01-10 jika ada
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = ($i < 10) ? 'ulangan0' . $i : 'ulangan' . $i;
                if ($request->filled($fieldName)) {
                    $fieldValue = $this->formatNumericValue($request->$fieldName);
                    if (!is_null($fieldValue)) {
                        $updateData[$fieldName] = $fieldValue;
                        \Log::debug("📝 {$fieldName} to update:", ['value' => $fieldValue]);
                    }
                }
            }
            
            \Log::info('📝 FINAL UpdateData for AddDialTestIndicator:', $updateData);
            
            // Update jika ada data
            if (!empty($updateData)) {
                $add->update($updateData);
                
                // VERIFIKASI: Cek data setelah update
                $add->refresh();
                \Log::info('✅ AddDialTestIndicator UPDATED. Current values:', [
                    'repeatability' => $add->repeatability,
                    'repeability' => $add->repeability,
                    'ulangan01' => $add->ulangan01,
                    'ulangan02' => $add->ulangan02,
                    'ulangan10' => $add->ulangan10,
                ]);
            } else {
                \Log::info('ℹ️ No data to update in AddDialTestIndicator');
            }
            
        } else {
            \Log::info('➕ Creating NEW AddDialTestIndicator');
            
            $addData = ['calibration_id' => $calibration->id];
            $hasData = false;
            
            // Handle repeatability/repeability untuk new record
            if ($request->filled('repeatability')) {
                $addData['repeatability'] = $this->formatRepeatability($request->repeatability);
                $hasData = true;
                \Log::info('📝 New repeatability:', ['value' => $addData['repeatability']]);
            } elseif ($request->filled('repeability')) {
                $addData['repeability'] = $this->formatRepeatability($request->repeability);
                $hasData = true;
                \Log::info('📝 New repeability:', ['value' => $addData['repeability']]);
            }
            
            // Handle ulangan fields untuk new record
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = ($i < 10) ? 'ulangan0' . $i : 'ulangan' . $i;
                if ($request->filled($fieldName)) {
                    $fieldValue = $this->formatNumericValue($request->$fieldName);
                    if (!is_null($fieldValue)) {
                        $addData[$fieldName] = $fieldValue;
                        $hasData = true;
                        \Log::debug("📝 New {$fieldName}:", ['value' => $fieldValue]);
                    }
                }
            }
            
            // Create jika ada data
            if ($hasData) {
                try {
                    $add = AddDialTestIndicator::create($addData);
                    \Log::info('✅ NEW AddDialTestIndicator CREATED:', [
                        'id' => $add->id,
                        'fields' => array_keys($addData)
                    ]);
                } catch (\Exception $e) {
                    \Log::error('❌ AddDialTestIndicator creation failed:', [
                        'error' => $e->getMessage(),
                        'data' => $addData
                    ]);
                }
            } else {
                \Log::info('ℹ️ No data to create AddDialTestIndicator');
            }
        }
        
        // ==================================================================
        // 4. UPDATE DETAIL MEASUREMENTS (penunjukanAlat, pembacaanNaik, pembacaanTurun)
        // ==================================================================
        $penunjukanAlat = $request->titikUkur ?? [];
        $pembacaanNaik = $request->ulanganNaik ?? [];
        $pembacaanTurun = $request->ulanganTurun ?? [];
        
        // DEBUG: Tampilkan sample data
        \Log::info('🔍 DETAIL DATA DEBUG:', [
            'penunjukanAlat_count' => count($penunjukanAlat),
            'penunjukanAlat_sample' => array_slice($penunjukanAlat, 0, 5),
            'pembacaanNaik_sample' => array_slice($pembacaanNaik, 0, 5),
            'pembacaanTurun_sample' => array_slice($pembacaanTurun, 0, 5),
        ]);
        
        // Hapus data detail lama
        $deletedCount = DetailDialTestIndicator::where('calibration_id', $calibration->id)->delete();
        \Log::info('🗑️ Old DetailDialTestIndicator deleted:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru
        $detailCount = 0;
        
        // Cek apakah data penunjukanAlat ada dan berupa array
        if (is_array($penunjukanAlat) && count($penunjukanAlat) > 0) {
            // Loop melalui semua penunjukanAlat
            foreach ($penunjukanAlat as $index => $titik) {
                // Skip jika null atau empty
                if (is_null($titik) || $titik === '') {
                    continue;
                }
                
                $naik = $pembacaanNaik[$index] ?? null;
                $turun = $pembacaanTurun[$index] ?? null;
                
                // Format nilai
                $formattedTitik = $this->formatNumericValue($titik);
                $formattedNaik = $this->formatNumericValue($naik);
                $formattedTurun = $this->formatNumericValue($turun);
                
                // Hanya simpan jika ada data
                if (!is_null($formattedTitik) || !is_null($formattedNaik) || !is_null($formattedTurun)) {
                    try {
                        $detailData = [
                            'calibration_id' => $calibration->id,
                            'titikUkur' => $formattedTitik,
                            'ulanganNaik' => $formattedNaik,
                            'ulanganTurun' => $formattedTurun,
                        ];
                        
                        DetailDialTestIndicator::create($detailData);
                        $detailCount++;
                        
                    } catch (\Exception $rowError) {
                        \Log::error("❌ DetailDialTestIndicator row {$index} error:", [
                            'error' => $rowError->getMessage(),
                            'data' => $detailData ?? []
                        ]);
                    }
                }
            }
        }
        
        \Log::info('✅ DetailDialTestIndicator updated:', ['total_records' => $detailCount]);
        
        // ==================================================================
        // 5. UPDATE CALIBRATED BY & VERIFIED BY (SESUAI DIAL INDICATOR)
        // ==================================================================
        $ttdUpdateData = [];
        
        // Mapping dari snake_case ke camelCase seperti di Dial Indicator
        if ($request->filled('calibrated_by') || $request->filled('calibratedBy')) {
            $ttdUpdateData['calibratedBy'] = $request->calibrated_by ?? $request->calibratedBy;
        }
        
        if ($request->filled('verified_by') || $request->filled('verifiedBy')) {
            $ttdUpdateData['verifiedBy'] = $request->verified_by ?? $request->verifiedBy;
        }
        
        if (!empty($ttdUpdateData)) {
            $calibration->update($ttdUpdateData);
            \Log::info('✅ TTD updated:', $ttdUpdateData);
        }
        
        \Log::info('🎉 updateDialTestIndicator completed');
        return true;
        
    } catch (\Exception $e) {
        \Log::error('💥 updateDialTestIndicator failed:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}


private function storeDepthCaliper($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeDepthCaliper');

        // ==================================================================
        // 1. PROSES & SIMPAN ALAT STANDAR KE HEAD
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarTambahan = $request->alat_standar_tambahan ?? '';

        \Log::info('🔧 Data alat standar:', [
            'alat_standar' => $alatStandar,
            'alat_standar_tambahan' => $alatStandarTambahan
        ]);

        $standardParts = [];
        foreach ($alatStandar as $alat) {
            if ($alat !== 'alat_standar_lainnya') {
                $standardParts[] = $alat;
            }
        }
        
        if (!empty($alatStandarTambahan)) {
            $standardParts[] = $alatStandarTambahan;
        }
        
        $standardValue = !empty($standardParts) ? implode(', ', $standardParts) : '';

        // SIMPAN KE HEAD DEPTH CALIPER
        $headData = HeadDepthCaliper::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => ' PAS-IK1102-11 (JIS B 7518:2023 (JMA/JSA); SNSU PK.P-02:2020)',
           
        ]);

        \Log::info('✅ HeadDepthCaliper berhasil disimpan', [
            'id' => $headData->id,
            'standard' => $standardValue,
            'calibration_id' => $calibration->id
        ]);

        // ==================================================================
        // 2. SIMPAN DETAIL DEPTH CALIPER
        // ==================================================================
        $titikUkur = $request->titikUkur ?? [];
        $ulangan01 = $request->ulangan01 ?? [];
        $ulangan02 = $request->ulangan02 ?? [];
        $ulangan03 = $request->ulangan03 ?? [];
        $ulangan04 = $request->ulangan04 ?? [];
        $ulangan05 = $request->ulangan05 ?? [];
        $kodeStandardKiri = $request->kodeStandardKiri ?? [];
        $kodeStandardKanan = $request->kodeStandardKanan ?? [];

        \Log::info('📊 Data detail diterima', [
            'titikUkur_count' => count($titikUkur),
            'ulangan01_count' => count($ulangan01),
            'ulangan02_count' => count($ulangan02),
            'ulangan03_count' => count($ulangan03),
            'ulangan04_count' => count($ulangan04),
            'ulangan05_count' => count($ulangan05),
            'kodeStandardKiri_count' => count($kodeStandardKiri),
            'kodeStandardKanan_count' => count($kodeStandardKanan),
        ]);

        $detailCount = 0;
        $errors = [];

        // Proses 12 baris data (sesuai dengan form yang memiliki 12 baris)
        $totalRows = min(12, count($titikUkur), count($ulangan01), count($ulangan02), 
                       count($ulangan03), count($ulangan04), count($ulangan05),
                       count($kodeStandardKiri), count($kodeStandardKanan));

        for ($i = 0; $i < $totalRows; $i++) {
            $titikValue = trim($titikUkur[$i] ?? '');
            $ulangan01Value = $ulangan01[$i] ?? null;
            $ulangan02Value = $ulangan02[$i] ?? null;
            $ulangan03Value = $ulangan03[$i] ?? null;
            $ulangan04Value = $ulangan04[$i] ?? null;
            $ulangan05Value = $ulangan05[$i] ?? null;
            $kodeKiriValue = $kodeStandardKiri[$i] ?? null;
            $kodeKananValue = $kodeStandardKanan[$i] ?? null;

            // SKIP jika semua kolom kosong
            if (empty($titikValue) && 
                empty($ulangan01Value) && 
                empty($ulangan02Value) && 
                empty($ulangan03Value) && 
                empty($ulangan04Value) && 
                empty($ulangan05Value) && 
                empty($kodeKiriValue) && 
                empty($kodeKananValue)) {
                \Log::debug('Baris ' . ($i + 1) . ' kosong, dilewati');
                continue;
            }

            // VALIDASI: Jika ada titikUkur, minimal harus ada 1 ulangan
            if (!empty($titikValue)) {
                $hasUlangan = !empty($ulangan01Value) || !empty($ulangan02Value) || 
                             !empty($ulangan03Value) || !empty($ulangan04Value) || 
                             !empty($ulangan05Value);
                
                if (!$hasUlangan) {
                    $errors[] = "Baris " . ($i + 1) . ": Titik Ukur '{$titikValue}' harus memiliki minimal 1 data ulangan";
                    \Log::warning('Validasi gagal: ' . end($errors));
                    continue;
                }
            }

            // Validasi: Jika ada ulangan, harus ada titikUkur
            $hasAnyUlangan = !empty($ulangan01Value) || !empty($ulangan02Value) || 
                           !empty($ulangan03Value) || !empty($ulangan04Value) || 
                           !empty($ulangan05Value);
            
            if ($hasAnyUlangan && empty($titikValue)) {
                $errors[] = "Baris " . ($i + 1) . ": Data ulangan harus memiliki Titik Ukur";
                \Log::warning('Validasi gagal: ' . end($errors));
                continue;
            }

            // Validasi: Jika ada kode standard, harus ada titikUkur
            if ((!empty($kodeKiriValue) || !empty($kodeKananValue)) && empty($titikValue)) {
                $errors[] = "Baris " . ($i + 1) . ": Kode Standard harus memiliki Titik Ukur";
                \Log::warning('Validasi gagal: ' . end($errors));
                continue;
            }

            // Format nilai ulangan ke float jika ada
            $formatUlangan = function($value) {
                if (empty($value)) return null;
                $value = str_replace(',', '.', $value);
                return is_numeric($value) ? (float) $value : null;
            };

            // SIMPAN DATA DETAIL
            try {
                DetailDepthCaliper::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => !empty($titikValue) ? $titikValue : null,
                    'ulangan01' => $formatUlangan($ulangan01Value),
                    'ulangan02' => $formatUlangan($ulangan02Value),
                    'ulangan03' => $formatUlangan($ulangan03Value),
                    'ulangan04' => $formatUlangan($ulangan04Value),
                    'ulangan05' => $formatUlangan($ulangan05Value),
                    'kodeStandardKiri' => !empty($kodeKiriValue) ? $kodeKiriValue : null,
                    'kodeStandardKanan' => !empty($kodeKananValue) ? $kodeKananValue : null,
                ]);

                $detailCount++;

                \Log::debug('📝 Detail baris ' . ($i + 1) . ' disimpan', [
                    'titikUkur' => $titikValue,
                    'ulangan01' => $ulangan01Value,
                    'ulangan02' => $ulangan02Value,
                ]);

            } catch (\Exception $e) {
                $errors[] = "Baris " . ($i + 1) . ": Gagal menyimpan - " . $e->getMessage();
                \Log::error('❌ Gagal simpan detail baris ' . ($i + 1), [
                    'error' => $e->getMessage(),
                    'data' => compact('titikValue', 'ulangan01Value', 'ulangan02Value')
                ]);
            }
        }

        // LOG HASIL AKHIR
        \Log::info('✅ DetailDepthCaliper berhasil disimpan', [
            'total_records' => $detailCount,
            'total_rows' => $totalRows,
            'calibration_id' => $calibration->id,
            'errors_count' => count($errors),
            'errors' => $errors
        ]);

        if (!empty($errors)) {
            \Log::warning('⚠️ Ada error dalam penyimpanan detail', ['errors' => $errors]);
            // Tidak throw error agar proses bisa lanjut, hanya log warning
        }

        // ==================================================================
        // 3. SIMPAN TTD DAN INFORMASI TAMBAHAN
        // ==================================================================
        // Data TTD sudah disimpan di calibration table melalui store method utama
        // Simpan informasi tambahan jika ada
        if ($request->has('additional_info') && !empty($request->additional_info)) {
            $calibration->update([
                'keterangan' => $request->additional_info
            ]);
            \Log::info('📝 Additional info saved to calibration');
        }

        \Log::info('🎉 storeDepthCaliper SELESAI');

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeDepthCaliper', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

/**
 * Update Depth Caliper data
 */
private function updateDepthCaliper($request, $calibration)
{
    \Log::info('🚀 START updateDepthCaliper');
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = '';
        
        \Log::info('🔧 Update data:', [
            'alat_standar' => $alatStandar,
            'alat_standar_tambahan' => $request->alat_standar_tambahan ?? ''
        ]);
        
        // Process alat standar
        $processedAlat = [];
        foreach ($alatStandar as $alat) {
            if ($alat === 'dial_gauge_tester_0_25mm') {
                $processedAlat[] = 'Dial Gauge Tester 0~25 mm';
            } 
            elseif ($alat === 'dial_calibration_tester_0_1mm') {
                $processedAlat[] = 'Dial Calibration Tester 0~1 mm';
            }
            elseif ($alat === 'electronic_gauge_tester_0_50mm') {
                $processedAlat[] = 'Electronic Gauge Tester 0~50 mm';
            }
            elseif ($alat === 'alat_standar_lainnya' && $request->filled('alat_standar_tambahan')) {
                $processedAlat[] = $request->alat_standar_tambahan;
            } else {
                $processedAlat[] = $alat;
            }
        }
        
        $alatStandarString = !empty($processedAlat) ? implode(', ', $processedAlat) : '';
        
        // Update atau create HEAD
        if ($head = $calibration->headDepthCaliper) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-05 (JIS B 7507 : 1993)',
            ]);
            
            \Log::info('✅ HeadDepthCaliper updated:', ['standard' => $alatStandarString]);
        } else {
            $head = HeadDepthCaliper::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-05 (JIS B 7507 : 1993)',
            ]);
            
            \Log::info('➕ NEW HeadDepthCaliper created:', ['head_id' => $head->id]);
        }
        
        // ==================================================================
        // 2. DEBUG: CEK STRUKTUR DATA DETAIL
        // ==================================================================
        \Log::info('🔍 DEBUG DETAIL DATA STRUCTURE:', [
            'has_detail' => $request->has('detail'),
            'detail_is_array' => is_array($request->detail),
            'detail_count' => is_array($request->detail) ? count($request->detail) : 0,
            'detail_sample' => is_array($request->detail) ? array_slice($request->detail, 0, 2) : [],
            'all_detail_keys' => is_array($request->detail) ? array_keys($request->detail) : [],
        ]);
        
        // ==================================================================
        // 3. UPDATE DETAIL MEASUREMENTS - MULTIDIMENSIONAL ARRAY
        // ==================================================================
        // Hapus data detail lama
        $deletedCount = DetailDepthCaliper::where('calibration_id', $calibration->id)->delete();
        \Log::info('🗑️ Old DetailDepthCaliper deleted:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru
        $detailCount = 0;
        
        if (is_array($request->detail) && count($request->detail) > 0) {
            foreach ($request->detail as $index => $rowData) {
                // Debug setiap row
                \Log::debug("🔍 Processing detail row {$index}:", $rowData);
                
                // Skip jika semua field kosong
                $isEmpty = true;
                foreach ($rowData as $value) {
                    if (!empty(trim($value ?? ''))) {
                        $isEmpty = false;
                        break;
                    }
                }
                
                if ($isEmpty) {
                    \Log::debug("⏭️ Skipping empty row {$index}");
                    continue;
                }
                
                try {
                    // Prepare data untuk detail
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $this->formatNumericValue($rowData['titikUkur'] ?? null),
                        'kodeStandardKiri' => $rowData['kodeStandardKiri'] ?? null,
                        'kodeStandardKanan' => $rowData['kodeStandardKanan'] ?? null,
                    ];
                    
                    // Tambahkan ulangan01 sampai ulangan05
                    for ($u = 1; $u <= 5; $u++) {
                        $fieldName = 'ulangan0' . $u;
                        $detailData[$fieldName] = $this->formatNumericValue($rowData[$fieldName] ?? null);
                    }
                    
                    // Jika ada kolom tambahan (col1-col8 untuk baris kosong)
                    for ($c = 1; $c <= 8; $c++) {
                        $colName = 'col' . $c;
                        if (isset($rowData[$colName])) {
                            // Untuk kolom umum, simpan sesuai mapping
                            if ($c == 1) {
                                $detailData['titikUkur'] = $this->formatNumericValue($rowData[$colName]);
                            } elseif ($c == 2) {
                                $detailData['kodeStandardKiri'] = $rowData[$colName];
                            } elseif ($c == 3) {
                                $detailData['kodeStandardKanan'] = $rowData[$colName];
                            } elseif ($c >= 4 && $c <= 8) {
                                $ulanganNum = $c - 3; // col4 -> ulangan01, col5 -> ulangan02, dst
                                $ulanganField = 'ulangan0' . $ulanganNum;
                                $detailData[$ulanganField] = $this->formatNumericValue($rowData[$colName]);
                            }
                        }
                    }
                    
                    \Log::debug("💾 Saving detail row {$index}:", $detailData);
                    
                    DetailDepthCaliper::create($detailData);
                    $detailCount++;
                    
                } catch (\Exception $rowError) {
                    \Log::error("❌ DetailDepthCaliper row {$index} error:", [
                        'error' => $rowError->getMessage(),
                        'data' => $rowData
                    ]);
                }
            }
        } else {
            \Log::warning('⚠️ No detail data found or detail is not an array');
        }
        
        \Log::info('✅ DetailDepthCaliper updated:', ['total_records' => $detailCount]);
        
        // ==================================================================
        // 4. UPDATE ADDITIONAL DATA (jika ada)
        // ==================================================================
        if ($add = $calibration->addDepthCaliper) {
            $updateData = [];
            
            // Handle repeatability jika ada
            if ($request->filled('repeatability')) {
                $updateData['repeatability'] = trim($request->repeatability);
            }
            
            // Handle ulangan tambahan jika ada
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = ($i < 10) ? 'ulangan0' . $i : 'ulangan' . $i;
                if ($request->filled($fieldName)) {
                    $fieldValue = $this->formatNumericValue($request->$fieldName);
                    if (!is_null($fieldValue)) {
                        $updateData[$fieldName] = $fieldValue;
                    }
                }
            }
            
            if (!empty($updateData)) {
                $add->update($updateData);
                \Log::info('✅ AddDepthCaliper updated');
            }
        }
        
        \Log::info('🎉 updateDepthCaliper completed');
        return true;
        
    } catch (\Exception $e) {
        \Log::error('💥 updateDepthCaliper failed:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}

private function storeCaliper($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeCaliper');
        
        // ==================================================================
        // 1. AMBIL & SIMPAN CAPACITY
        // ==================================================================
        $capacity = $request->capacity ?? '300';
        if (!in_array($capacity, ['300', '450', '600', '1000'])) {
            $capacity = '300';
        }

        $calibration->update([
            'capacity' => $capacity,
        ]);

        \Log::info('Capacity tersimpan', ['capacity' => $capacity]);

        // ==================================================================
        // 2. PROSES & SIMPAN ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarTambahan = $request->alat_standar_tambahan ?? '';

        $standardParts = [];
        foreach ($alatStandar as $alat) {
            if ($alat !== 'alat_standar_lainnya') {
                $standardParts[] = $alat;
            }
        }
        
        if (!empty($alatStandarTambahan)) {
            $standardParts[] = $alatStandarTambahan;
        }
        
        $standardValue = !empty($standardParts) ? implode(', ', $standardParts) : '';

        // SIMPAN HEAD CALIPER
        $headData = HeadCaliper::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-03 (JIS B 7507:2022 (JMA/JSA); SNSU PK.P-02:2020).',
            'kapasitas' => $capacity,
        ]);

        \Log::info('✅ HeadCaliper disimpan', ['standard' => $standardValue]);

        // ==================================================================
        // 3. SIMPAN SEMUA DATA PENGUKURAN DARI FORM
        // ==================================================================
        // Ambil semua data dari form
        $outsideTitikUkur = $request->input('outside_titik_ukur', []);
        $insideTitikUkur = $request->input('inside_titik_ukur', []);
        
        // Gabungkan semua titik ukur (8 outside + 7 inside = 15 total)
        $allTitikUkur = array_merge($outsideTitikUkur, $insideTitikUkur);
        
        // Data outside
        $outside01 = $request->input('outside_ulangan01', []);
        $outside02 = $request->input('outside_ulangan02', []);
        $outside03 = $request->input('outside_ulangan03', []);
        $outside04 = $request->input('outside_ulangan04', []);
        $outside05 = $request->input('outside_ulangan05', []);
        
        // Data inside
        $inside01 = $request->input('inside_ulangan01', []);
        $inside02 = $request->input('inside_ulangan02', []);
        $inside03 = $request->input('inside_ulangan03', []);
        $inside04 = $request->input('inside_ulangan04', []);
        $inside05 = $request->input('inside_ulangan05', []);
        
        \Log::info('📊 Semua data diterima:', [
            'total_titik_ukur' => count($allTitikUkur),
            'outside_count' => count($outsideTitikUkur),
            'inside_count' => count($insideTitikUkur),
        ]);

        // ==================================================================
        // 4. SIMPAN 15 BARIS DATA SEKALIGUS
        // ==================================================================
        for ($i = 0; $i < 15; $i++) {
            // Cek apakah ini baris outside (0-7) atau inside (8-14)
            $titikUkur = null;
            $outsideData = ['outside01' => null, 'outside02' => null, 'outside03' => null, 'outside04' => null, 'outside05' => null];
            $insideData = ['inside01' => null, 'inside02' => null, 'inside03' => null, 'inside04' => null, 'inside05' => null];
            
            if ($i < 8 && isset($outsideTitikUkur[$i])) {
                // Baris Outside (0-7)
                $titikUkur = $outsideTitikUkur[$i];
                $outsideData = [
                    'outside01' => $outside01[$i] ?? null,
                    'outside02' => $outside02[$i] ?? null,
                    'outside03' => $outside03[$i] ?? null,
                    'outside04' => $outside04[$i] ?? null,
                    'outside05' => $outside05[$i] ?? null,
                ];
            } elseif ($i >= 8 && isset($insideTitikUkur[$i-8])) {
                // Baris Inside (8-14)
                $titikUkur = $insideTitikUkur[$i-8];
                $insideData = [
                    'inside01' => $inside01[$i-8] ?? null,
                    'inside02' => $inside02[$i-8] ?? null,
                    'inside03' => $inside03[$i-8] ?? null,
                    'inside04' => $inside04[$i-8] ?? null,
                    'inside05' => $inside05[$i-8] ?? null,
                ];
            }
            
            // Jika ada titik ukur, simpan ke database
            if ($titikUkur !== null) {
                DetailCaliper::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $titikUkur,
                    'outside01' => $outsideData['outside01'],
                    'outside02' => $outsideData['outside02'],
                    'outside03' => $outsideData['outside03'],
                    'outside04' => $outsideData['outside04'],
                    'outside05' => $outsideData['outside05'],
                    'inside01' => $insideData['inside01'],
                    'inside02' => $insideData['inside02'],
                    'inside03' => $insideData['inside03'],
                    'inside04' => $insideData['inside04'],
                    'inside05' => $insideData['inside05'],
                ]);
                
                \Log::debug("📝 Row {$i} saved", ['titikUkur' => $titikUkur]);
            }
        }

        // ==================================================================
        // 5. SIMPAN DATA TAMBAHAN
        // ==================================================================
        AddCaliper::create([
            'calibration_id' => $calibration->id,
            'titikUkurKesajajaran' => $request->titikUkurKesajajaran ?? null,
            'kesejajaranAwal' => $request->kesejajaranAwal ?? null,
            'kesejajaranTengah' => $request->kesejajaranTengah ?? null,
            'kesejajaranAkhir' => $request->kesejajaranAkhir ?? null,
            'pengukuranDalamPisauBersilang' => $request->pengukuranDalamPisauBersilang ?? null,
            'pembacaan1' => $request->pembacaan1 ?? null,
            'pembacaan2' => $request->pembacaan2 ?? null,
            'pembacaan3' => $request->pembacaan3 ?? null,
        ]);

        // ==================================================================
        // 6. UPDATE CALIBRATION
        // ==================================================================
        if ($request->has('uncertainty') && !empty($request->uncertainty)) {
            $calibration->update([
                'uncertainty' => $request->uncertainty,
                'keterangan' => $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi',
                'kapasitas' => $capacity,
            ]);
        }

        // Hitung total records
        $totalRecords = DetailCaliper::where('calibration_id', $calibration->id)->count();

        \Log::info('✅ Semua data Caliper berhasil disimpan', [
            'total_records' => $totalRecords,
            'calibration_id' => $calibration->id,
            'capacity' => $capacity
        ]);

        \Log::info('🎉 storeCaliper SELESAI');

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeCaliper', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

/**
 * Method update untuk Caliper - SIMPAN SEMUA TANPA KONDISI
 */
private function updateCaliper($request, $calibration)
{
    try {
        \Log::info('🚀 START updateCaliper');
        
        // ==================================================================
        // 1. UPDATE CAPACITY (simpan ke kolom 'capacity')
        // ==================================================================
        $capacity = $request->capacity ?? ($calibration->capacity ?? '300');
        
        // Validasi nilai capacity
        $validCapacities = ['300', '450', '600', '1000', 300, 450, 600, 1000];
        if (!in_array($capacity, $validCapacities)) {
            $capacity = '300';
        }
        
        // Konversi ke string atau integer sesuai kebutuhan database
        $capacityValue = is_numeric($capacity) ? (string) $capacity : $capacity;

        // Update capacity (bukan skala)
        $updateData = [];
        if ($calibration->capacity !== $capacityValue) {
            $updateData['capacity'] = $capacityValue;
            \Log::info('Capacity akan diupdate', [
                'old' => $calibration->capacity,
                'new' => $capacityValue
            ]);
        }
        
        // Update calibration jika ada perubahan
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        \Log::info('Capacity diupdate', ['capacity' => $capacityValue]);

        // ==================================================================
        // 2. UPDATE HEAD CALIPER
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarTambahan = $request->alat_standar_tambahan ?? '';
        
        $standardParts = [];
        foreach ($alatStandar as $alat) {
            if ($alat !== 'alat_standar_lainnya' && !empty($alat)) {
                $standardParts[] = $alat;
            }
        }
        
        if (!empty($alatStandarTambahan) && trim($alatStandarTambahan) !== '') {
            $standardParts[] = trim($alatStandarTambahan);
        }
        
        $standardValue = !empty($standardParts) ? implode(', ', $standardParts) : null;

        // Cek apakah head caliper sudah ada
        $headCaliper = HeadCaliper::where('calibration_id', $calibration->id)->first();
        
        if ($headCaliper) {
            $headCaliper->update([
                'standard' => $standardValue,
                'kapasitas' => $capacityValue,
                'updated_at' => now(),
            ]);
            \Log::info('✅ HeadCaliper diupdate', ['kapasitas' => $capacityValue]);
        } else {
            // Buat baru jika tidak ada
            HeadCaliper::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id,
                'standard' => $standardValue,
                'calibrationMethod' => 'PAS-IK1102-03 (JIS B 7507:2022 (JMA/JSA); SNSU PK.P-02:2020).',
                'kapasitas' => $capacityValue,
            ]);
            \Log::info('✅ HeadCaliper dibuat baru', ['kapasitas' => $capacityValue]);
        }

        // ==================================================================
        // 3. UPDATE DATA DETAIL CALIPER - DENGAN STRUKTUR INPUT YANG SESUAI
        // ==================================================================
        
        // Debug: Log semua data yang diterima
        \Log::info('📥 Data yang diterima dari form:', [
            'outside_data_exists' => $request->has('outside'),
            'inside01_exists' => $request->has('inside01'),
            'inside02_exists' => $request->has('inside02'),
            'inside03_exists' => $request->has('inside03'),
            'inside04_exists' => $request->has('inside04'),
            'inside05_exists' => $request->has('inside05'),
        ]);

        // Update atau insert data OUTSIDE jika ada
        if ($request->has('outside')) {
            \Log::info('🔄 Processing outside data...', ['count' => count($request->outside)]);
            
            foreach ($request->outside as $index => $outsideData) {
                if (isset($outsideData['titikUkur'])) {
                    $titikUkur = $outsideData['titikUkur'];
                    
                    // Cari data existing berdasarkan calibration_id dan titikUkur
                    $existingDetail = DetailCaliper::where('calibration_id', $calibration->id)
                        ->where('titikUkur', $titikUkur)
                        ->first();
                    
                    if ($existingDetail) {
                        // Update existing record
                        $existingDetail->update([
                            'outside01' => $this->sanitizeMeasurement($outsideData['outside01'] ?? null),
                            'outside02' => $this->sanitizeMeasurement($outsideData['outside02'] ?? null),
                            'outside03' => $this->sanitizeMeasurement($outsideData['outside03'] ?? null),
                            'outside04' => $this->sanitizeMeasurement($outsideData['outside04'] ?? null),
                            'outside05' => $this->sanitizeMeasurement($outsideData['outside05'] ?? null),
                            'updated_at' => now(),
                        ]);
                        \Log::info("✅ Outside row {$index} (titik {$titikUkur}) updated");
                    } else {
                        // Create new record
                        DetailCaliper::create([
                            'calibration_id' => $calibration->id,
                            'titikUkur' => $titikUkur,
                            'outside01' => $this->sanitizeMeasurement($outsideData['outside01'] ?? null),
                            'outside02' => $this->sanitizeMeasurement($outsideData['outside02'] ?? null),
                            'outside03' => $this->sanitizeMeasurement($outsideData['outside03'] ?? null),
                            'outside04' => $this->sanitizeMeasurement($outsideData['outside04'] ?? null),
                            'outside05' => $this->sanitizeMeasurement($outsideData['outside05'] ?? null),
                        ]);
                        \Log::info("✅ Outside row {$index} (titik {$titikUkur}) created");
                    }
                }
            }
        }

        // Update atau insert data INSIDE jika ada
        if ($request->has('inside01')) {
            \Log::info('🔄 Processing inside data...', [
                'inside01_count' => count($request->inside01),
                'inside02_count' => count($request->inside02 ?? []),
                'inside03_count' => count($request->inside03 ?? []),
                'inside04_count' => count($request->inside04 ?? []),
                'inside05_count' => count($request->inside05 ?? []),
            ]);
            
            // Perlu mendapatkan titik ukur untuk inside
            // Karena inside menggunakan array sederhana, kita perlu tahu titik ukur
            $capacity = $calibration->capacity ?? 300;
            $insideValues = [];
            
            if ($capacity == 300) {
                $insideValues = [20, 50, 100, 150, 200, 250, 300];
            } elseif ($capacity == 450) {
                $insideValues = [50, 100, 200, 300, 350, 400, 450];
            } elseif ($capacity == 600) {
                $insideValues = [50, 100, 200, 300, 400, 500, 600];
            } elseif ($capacity == 1000) {
                $insideValues = [100, 300, 500, 700, 800, 900, 1000];
            }
            
            // Loop melalui data inside (maksimal 7 baris)
            for ($i = 0; $i < min(7, count($request->inside01)); $i++) {
                $titikUkur = $insideValues[$i] ?? null;
                
                if ($titikUkur) {
                    // Cari data existing berdasarkan calibration_id dan titikUkur
                    $existingDetail = DetailCaliper::where('calibration_id', $calibration->id)
                        ->where('titikUkur', $titikUkur)
                        ->first();
                    
                    if ($existingDetail) {
                        // Update existing record dengan data inside
                        $existingDetail->update([
                            'inside01' => $this->sanitizeMeasurement($request->inside01[$i] ?? null),
                            'inside02' => $this->sanitizeMeasurement($request->inside02[$i] ?? null),
                            'inside03' => $this->sanitizeMeasurement($request->inside03[$i] ?? null),
                            'inside04' => $this->sanitizeMeasurement($request->inside04[$i] ?? null),
                            'inside05' => $this->sanitizeMeasurement($request->inside05[$i] ?? null),
                            'updated_at' => now(),
                        ]);
                        \Log::info("✅ Inside row {$i} (titik {$titikUkur}) updated");
                    } else {
                        // Create new record untuk inside
                        DetailCaliper::create([
                            'calibration_id' => $calibration->id,
                            'titikUkur' => $titikUkur,
                            'inside01' => $this->sanitizeMeasurement($request->inside01[$i] ?? null),
                            'inside02' => $this->sanitizeMeasurement($request->inside02[$i] ?? null),
                            'inside03' => $this->sanitizeMeasurement($request->inside03[$i] ?? null),
                            'inside04' => $this->sanitizeMeasurement($request->inside04[$i] ?? null),
                            'inside05' => $this->sanitizeMeasurement($request->inside05[$i] ?? null),
                        ]);
                        \Log::info("✅ Inside row {$i} (titik {$titikUkur}) created");
                    }
                }
            }
        }

        // ==================================================================
        // 4. UPDATE ADD CALIPER
        // ==================================================================
        $addCaliperData = [
            'calibration_id' => $calibration->id,
            'titikUkurKesajajaran' => $this->sanitizeMeasurement($request->titikUkurKesajajaran ?? null),
            'kesejajaranAwal' => $this->sanitizeMeasurement($request->kesejajaranAwal ?? null),
            'kesejajaranTengah' => $this->sanitizeMeasurement($request->kesejajaranTengah ?? null),
            'kesejajaranAkhir' => $this->sanitizeMeasurement($request->kesejajaranAkhir ?? null),
            'pengukuranDalamPisauBersilang' => $this->sanitizeMeasurement($request->pengukuranDalamPisauBersilang ?? null),
            'pembacaan1' => $this->sanitizeMeasurement($request->pembacaan1 ?? null),
            'pembacaan2' => $this->sanitizeMeasurement($request->pembacaan2 ?? null),
            'pembacaan3' => $this->sanitizeMeasurement($request->pembacaan3 ?? null),
        ];
        
        $existingAddCaliper = AddCaliper::where('calibration_id', $calibration->id)->first();
        
        if ($existingAddCaliper) {
            $existingAddCaliper->update($addCaliperData);
            \Log::info('✅ AddCaliper diupdate');
        } else {
            AddCaliper::create($addCaliperData);
            \Log::info('✅ AddCaliper dibuat baru');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION TERAKHIR
        // ==================================================================
        $calibrationUpdateData = [];
        
        // Update capacity jika belum diupdate sebelumnya
        if ($calibration->capacity !== $capacityValue) {
            $calibrationUpdateData['capacity'] = $capacityValue;
        }
        
        // Update uncertainty jika ada
        if ($request->has('uncertainty') && $request->uncertainty !== null) {
            $calibrationUpdateData['uncertainty'] = $this->sanitizeMeasurement($request->uncertainty);
        }
        
        // Update keterangan jika ada
        if ($request->has('conclusion') && $request->conclusion !== null) {
            $calibrationUpdateData['keterangan'] = $request->conclusion;
        }
        
        // Update jika ada data yang berubah
        if (!empty($calibrationUpdateData)) {
            $calibration->update($calibrationUpdateData);
            \Log::info('✅ Calibration data diupdate', $calibrationUpdateData);
        }

        // ==================================================================
        // 6. VERIFIKASI DATA
        // ==================================================================
        $totalDetailRecords = DetailCaliper::where('calibration_id', $calibration->id)->count();
        $headExists = HeadCaliper::where('calibration_id', $calibration->id)->exists();
        $addExists = AddCaliper::where('calibration_id', $calibration->id)->exists();

        \Log::info('✅ Semua data Caliper berhasil diupdate', [
            'total_detail_records' => $totalDetailRecords,
            'head_caliper_exists' => $headExists,
            'add_caliper_exists' => $addExists,
            'calibration_id' => $calibration->id,
            'capacity' => $calibration->capacity,
            'final_uncertainty' => $calibration->uncertainty,
            'final_keterangan' => $calibration->keterangan
        ]);

        \Log::info('🎉 updateCaliper SELESAI');

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateCaliper', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

private function sanitizeMeasurement($value)
{
    if (is_null($value) || $value === '') {
        return null;
    }
    
    // Hapus spasi dan karakter non-numerik kecuali titik dan minus
    $cleaned = preg_replace('/[^\d\.\-]/', '', (string) $value);
    
    // Cek jika hasilnya kosong
    if ($cleaned === '' || $cleaned === null) {
        return null;
    }
    
    // Pastikan format angka yang valid
    if (!is_numeric($cleaned)) {
        return null;
    }
    
    // Konversi ke float dan format dengan 2 digit desimal
    return number_format((float) $cleaned, 2, '.', '');
}

private function storeTorqueWrench($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeTorqueWrench - Simple Version');

        // ==================================================================
        // 1. PROSES ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';

        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandarString]);

        // ==================================================================
        // 2. SIMPAN KE HEAD TORQUE WRENCH
        // ==================================================================
        $head = HeadTorqueWrench::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-13 (JIS B 4652:2008)',
        ]);

        \Log::info('✅ HeadTorqueWrench saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL KALIBRASI (13 BARIS)
        // ==================================================================
        \Log::info('📊 Saving detail measurements...');
        $detailCount = 0;

        for ($i = 1; $i <= 13; $i++) {
            $titikUkur = $request->{"row{$i}_col0"} ?? null;
            $cw1 = $request->{"row{$i}_col1"} ?? null;
            $cw2 = $request->{"row{$i}_col2"} ?? null;
            $cw3 = $request->{"row{$i}_col3"} ?? null;
            $ccw1 = $request->{"row{$i}_col4"} ?? null;
            $ccw2 = $request->{"row{$i}_col5"} ?? null;
            $ccw3 = $request->{"row{$i}_col6"} ?? null;

            // Simpan hanya jika ada data (minimal satu kolom terisi)
            if ($titikUkur !== null || $cw1 !== null || $cw2 !== null || $cw3 !== null || 
                $ccw1 !== null || $ccw2 !== null || $ccw3 !== null) {
                
                DetailTorqueWrench::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $titikUkur,
                    'cw1' => $cw1,
                    'cw2' => $cw2,
                    'cw3' => $cw3,
                    'ccw1' => $ccw1,
                    'ccw2' => $ccw2,
                    'ccw3' => $ccw3,
                ]);
                
                $detailCount++;
            }
        }

        \Log::info("✅ Saved {$detailCount} detail records");

        // ==================================================================
        // 4. SIMPAN ADD TORQUE WRENCH (SEMUA 10 FIELD)
        // ==================================================================
        \Log::info('🔄 Saving AddTorqueWrench data...');
        
        // Data untuk AddTorqueWrench - semua 10 field
        $addData = [
            'calibration_id' => $calibration->id,
            
            // Clockwise 1-10
            'repCw01' => $request->repeat_cw_1 ?? null,
            'repCw02' => $request->repeat_cw_2 ?? null,
            'repCw03' => $request->repeat_cw_3 ?? null,
            'repCw04' => $request->repeat_cw_4 ?? null,
            'repCw05' => $request->repeat_cw_5 ?? null,
            'repCw06' => $request->repeat_cw_6 ?? null,
            'repCw07' => $request->repeat_cw_7 ?? null,
            'repCw08' => $request->repeat_cw_8 ?? null,
            'repCw09' => $request->repeat_cw_9 ?? null,
            'repCw10' => $request->repeat_cw_10 ?? null,
            
            // Counter Clockwise 1-10
            'repCcw01' => $request->repeat_ccw_1 ?? null,
            'repCcw02' => $request->repeat_ccw_2 ?? null,
            'repCcw03' => $request->repeat_ccw_3 ?? null,
            'repCcw04' => $request->repeat_ccw_4 ?? null,
            'repCcw05' => $request->repeat_ccw_5 ?? null,
            'repCcw06' => $request->repeat_ccw_6 ?? null,
            'repCcw07' => $request->repeat_ccw_7 ?? null,
            'repCcw08' => $request->repeat_ccw_8 ?? null,
            'repCcw09' => $request->repeat_ccw_9 ?? null,
            'repCcw10' => $request->repeat_ccw_10 ?? null,
        ];

        // Cek apakah ada data yang perlu disimpan (minimal satu field terisi)
        $hasData = false;
        foreach ($addData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasData = true;
                break;
            }
        }

        if ($hasData) {
            $addRecord = AddTorqueWrench::create($addData);
            \Log::info('✅ AddTorqueWrench saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddTorqueWrench data to save');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION JIKA ADA DATA TAMBAHAN
        // ==================================================================
        if ($request->has('uncertainty') && $request->uncertainty !== null) {
            $calibration->update([
                'uncertainty' => $request->uncertainty,
                'keterangan' => $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi',
            ]);
            \Log::info('📝 Calibration updated with uncertainty data');
        }

        // ==================================================================
        // 6. LOG HASIL
        // ==================================================================
        $savedDetailCount = DetailTorqueWrench::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddTorqueWrench::where('calibration_id', $calibration->id)->count();

        \Log::info('📋 STORE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
        ]);

        \Log::info('🎉 storeTorqueWrench COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeTorqueWrench:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailTorqueWrench::where('calibration_id', $calibration->id)->delete();
                AddTorqueWrench::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Torque Wrench: " . $e->getMessage());
    }
}

private function updateTorqueWrench($request, $calibration)
{
    \Log::channel('calibration')->info('🚀 ===== START updateTorqueWrench =====', [
        'calibration_id' => $calibration->id,
        'certificate_id' => $calibration->headTorqueWrench->certificate_id ?? 'N/A',
        'timestamp' => now()->toDateTimeString()
    ]);
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR & HEAD DATA
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::channel('calibration')->info('🔧 ALAT STANDAR UPDATE:', [
            'count' => count($alatStandar),
            'items' => $alatStandar,
            'string_value' => $alatStandarString,
            'old_value' => $calibration->headTorqueWrench->standard ?? 'null'
        ]);

        // Update atau create head data dengan field baru dari input
        if ($head = $calibration->headTorqueWrench) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1101-01 (ISO 6789-1:2017; SNSU PK.P-01:2020)',
                'clockwise_unit' => $request->clockwise_unit ?? null,
                'counter_clockwise_unit' => $request->counter_clockwise_unit ?? null,
                'nominal_unit' => $request->nominal_unit ?? null,
            ]);
            
            \Log::channel('calibration')->info('✅ HEAD DATA UPDATED:', [
                'head_id' => $head->id,
                'standard_updated' => true,
                'method_updated' => true,
                'clockwise_unit' => $request->clockwise_unit,
                'counter_clockwise_unit' => $request->counter_clockwise_unit,
                'nominal_unit' => $request->nominal_unit,
            ]);
        } else {
            \Log::channel('calibration')->warning('⚠️ NO HEAD DATA FOUND, creating new...');
            
            $head = HeadTorqueWrench::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1101-01 (ISO 6789-1:2017; SNSU PK.P-01:2020)',
                'clockwise_unit' => $request->clockwise_unit ?? null,
                'counter_clockwise_unit' => $request->counter_clockwise_unit ?? null,
                'nominal_unit' => $request->nominal_unit ?? null,
            ]);
            
            \Log::channel('calibration')->info('➕ NEW HEAD CREATED:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL MEASUREMENTS (13 baris)
        // ==================================================================
        \Log::channel('calibration')->info('📊 DETAIL MEASUREMENTS UPDATE:', [
            'old_records_count' => DetailTorqueWrench::where('calibration_id', $calibration->id)->count(),
            'torque_data_count' => is_array($request->torque) ? count($request->torque) : 0
        ]);
        
        // Log sample of incoming data
        if (is_array($request->torque) && count($request->torque) > 0) {
            \Log::channel('calibration')->debug('📝 INCOMING TORQUE DATA SAMPLE (first 3 rows):', [
                'row_0' => $request->torque[0] ?? [],
                'row_1' => $request->torque[1] ?? [],
                'row_2' => $request->torque[2] ?? [],
            ]);
        }
        
        // Hapus data detail lama
        $deletedCount = DetailTorqueWrench::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD DETAIL DATA DELETED:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru - 13 BARIS (sesuai dengan input HTML)
        $detailCount = 0;
        $errors = [];
        
        for ($i = 0; $i < 13; $i++) {
            $torqueData = $request->torque[$i] ?? [];
            
            // Check if row has data
            $hasData = !empty($torqueData) && (
                !empty(trim($torqueData['titikUkur'] ?? '')) || 
                !empty(trim($torqueData['cw1'] ?? '')) || 
                !empty(trim($torqueData['cw2'] ?? '')) || 
                !empty(trim($torqueData['cw3'] ?? '')) || 
                !empty(trim($torqueData['ccw1'] ?? '')) || 
                !empty(trim($torqueData['ccw2'] ?? '')) || 
                !empty(trim($torqueData['ccw3'] ?? ''))
            );
            
            if ($hasData) {
                try {
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $this->formatNumericValue($torqueData['titikUkur'] ?? null),
                        'cw1' => $this->formatNumericValue($torqueData['cw1'] ?? null),
                        'cw2' => $this->formatNumericValue($torqueData['cw2'] ?? null),
                        'cw3' => $this->formatNumericValue($torqueData['cw3'] ?? null),
                        'ccw1' => $this->formatNumericValue($torqueData['ccw1'] ?? null),
                        'ccw2' => $this->formatNumericValue($torqueData['ccw2'] ?? null),
                        'ccw3' => $this->formatNumericValue($torqueData['ccw3'] ?? null),
                    ];
                    
                    \Log::channel('calibration')->debug("💾 SAVING TORQUE ROW {$i}:", [
                        'row' => $i,
                        'data' => $detailData
                    ]);
                    
                    DetailTorqueWrench::create($detailData);
                    $detailCount++;
                    
                } catch (\Exception $rowError) {
                    $errors[] = "Row {$i}: " . $rowError->getMessage();
                    \Log::channel('calibration')->error("❌ TORQUE ROW {$i} SAVE ERROR:", [
                        'error' => $rowError->getMessage(),
                        'data' => $torqueData
                    ]);
                }
            } else {
                \Log::channel('calibration')->debug("⏭️ SKIPPING EMPTY TORQUE ROW {$i}");
            }
        }
        
        \Log::channel('calibration')->info("✅ DETAIL TORQUE DATA SAVED:", [
            'total_records' => $detailCount,
            'errors_count' => count($errors),
            'errors' => $errors
        ]);

        // ==================================================================
        // 3. UPDATE ADDITIONAL DATA (AddTorqueWrench)
        // ==================================================================
        \Log::channel('calibration')->info('📊 ADDITIONAL DATA UPDATE:');
        
        // Hapus data additional lama
        $deletedAddCount = AddTorqueWrench::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD ADDITIONAL DATA DELETED:', ['deleted_count' => $deletedAddCount]);
        
        // Simpan data additional baru
        $addData = [
            'calibration_id' => $calibration->id,
        ];
        
        // Data Repeatability Clockwise (repCw01 - repCw10)
        for ($i = 1; $i <= 10; $i++) {
            $fieldName = 'repCw' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $addData[$fieldName] = $this->formatNumericValue($request->{$fieldName} ?? null);
        }
        
        // Data Repeatability Counter Clockwise (repCcw01 - repCcw10)
        for ($i = 1; $i <= 10; $i++) {
            $fieldName = 'repCcw' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $addData[$fieldName] = $this->formatNumericValue($request->{$fieldName} ?? null);
        }
        
        // Filter hanya field yang ada di fillable model
        $fillable = (new AddTorqueWrench())->getFillable();
        $filteredData = ['calibration_id' => $calibration->id];
        
        foreach ($addData as $key => $value) {
            if (in_array($key, $fillable) || $key === 'calibration_id') {
                $filteredData[$key] = $value;
            }
        }
        
        try {
            AddTorqueWrench::create($filteredData);
            \Log::channel('calibration')->info('✅ ADDITIONAL DATA SAVED:', [
                'total_fields' => count($filteredData),
                'sample_cw' => [
                    'repCw01' => $filteredData['repCw01'] ?? null, 
                    'repCw02' => $filteredData['repCw02'] ?? null
                ],
                'sample_ccw' => [
                    'repCcw01' => $filteredData['repCcw01'] ?? null, 
                    'repCcw02' => $filteredData['repCcw02'] ?? null
                ]
            ]);
        } catch (\Exception $addError) {
            \Log::channel('calibration')->error('❌ ADDITIONAL DATA SAVE ERROR:', [
                'error' => $addError->getMessage(),
                'data_sample' => array_slice($filteredData, 0, 5)
            ]);
            throw $addError;
        }

        // ==================================================================
        // 4. VERIFY SAVED DATA
        // ==================================================================
        $savedDetails = DetailTorqueWrench::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::channel('calibration')->info('🔍 VERIFY SAVED TORQUE DATA:', [
            'total_saved' => $savedDetails->count(),
            'first_3_rows_sample' => $savedDetails->take(3)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkur' => $item->titikUkur,
                    'cw1' => $item->cw1,
                    'cw2' => $item->cw2,
                    'cw3' => $item->cw3,
                    'ccw1' => $item->ccw1,
                    'created_at' => $item->created_at
                ];
            })->toArray()
        ]);

        // ==================================================================
        // 5. UPDATE CALIBRATION ADDITIONAL DATA
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibratedBy')) {
            $updateData['calibrated_by'] = $request->calibratedBy;
        }
        
        if ($request->filled('verifiedBy')) {
            $updateData['verified_by'] = $request->verifiedBy;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Tambahan khusus untuk Torque Wrench
        if ($request->filled('unit')) {
            $updateData['unit'] = $request->unit;
        }
        
        if ($request->filled('temperature')) {
            $updateData['temperature'] = $request->temperature;
        }
        
        if ($request->filled('humidity')) {
            $updateData['humidity'] = $request->humidity;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::channel('calibration')->info('📝 CALIBRATION ADDITIONAL DATA UPDATED:', $updateData);
        }

        // ==================================================================
        // 6. FINAL SUMMARY
        // ==================================================================
        $finalDetailCount = DetailTorqueWrench::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddTorqueWrench::where('calibration_id', $calibration->id)->count();
        
        \Log::channel('calibration')->info('📋 UPDATE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'certificate_id' => $head->certificate_id ?? 'N/A',
            'detail_records' => $finalDetailCount,
            'additional_records' => $finalAddCount,
            'alat_standar' => $alatStandarString,
            'clockwise_unit' => $head->clockwise_unit,
            'counter_clockwise_unit' => $head->counter_clockwise_unit,
            'nominal_unit' => $head->nominal_unit,
            'calibrated_by' => $calibration->calibrated_by,
            'verified_by' => $calibration->verified_by,
            'unit' => $calibration->unit,
            'temperature' => $calibration->temperature,
            'humidity' => $calibration->humidity,
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_peak' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);

        \Log::channel('calibration')->info('🎉 updateTorqueWrench COMPLETED SUCCESSFULLY');
        return true;

    } catch (\Exception $e) {
        \Log::channel('calibration')->error('💥 updateTorqueWrench FAILED:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}




private function storeTorqueMeter($request, $calibration, $certificateId)
{
    try {
        \Log::info('START storeTorqueMeter - Final Version');

        // ==================================================================
        // 1. PROSES ALAT STANDAR — SUPPORT TEXTAREA + ARRAY (FUTURE-PROOF)
        // ==================================================================
        $textValue  = trim($request->alat_standar_text ?? '');
        $arrayValue = $request->input('alat_standar', []); // bisa null atau array

        if (!empty($textValue)) {
            $standardValue = $textValue; // Prioritas: textarea (yang dipakai sekarang)
        } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
            $standardValue = implode("\n", $arrayValue); // Fallback ke checkbox
        } else {
            $standardValue = '';
        }

        \Log::info('Alat Standar Final:', [
            'textarea' => $textValue,
            'checkbox_array' => $arrayValue,
            'saved_to_db' => $standardValue
        ]);

        // ==================================================================
        // 2. SIMPAN KE HEAD TORQUE METER
        // ==================================================================
        $head = HeadTorqueMeter::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard'       => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-13B (ASTM D 3474-90 : 2018)',
        ]);

        \Log::info('HeadTorqueMeter saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL KALIBRASI (13 BARIS) — Tetap sama
        // ==================================================================
        $detailCount = 0;
        for ($i = 1; $i <= 13; $i++) {
            $titikUkurBeban = $request->{"row{$i}_col0"} ?? null;
            $kodeStandard   = $request->{"row{$i}_col1"} ?? null;
            $cw1 = $request->{"row{$i}_col2"} ?? null;
            $cw2 = $request->{"row{$i}_col3"} ?? null;
            $cw3 = $request->{"row{$i}_col4"} ?? null;
            $ccw1 = $request->{"row{$i}_col5"} ?? null;
            $ccw2 = $request->{"row{$i}_col6"} ?? null;
            $ccw3 = $request->{"row{$i}_col7"} ?? null;

            if ($titikUkurBeban !== null || $kodeStandard !== null || $cw1 !== null || 
                $cw2 !== null || $cw3 !== null || $ccw1 !== null || $ccw2 !== null || $ccw3 !== null) {
                
                DetailTorqueMeter::create([
                    'calibration_id' => $calibration->id,
                    'titikUkurBeban' => $titikUkurBeban,
                    'kodeStandard'   => $kodeStandard,
                    'cw1' => $cw1, 'cw2' => $cw2, 'cw3' => $cw3,
                    'ccw1' => $ccw1, 'ccw2' => $ccw2, 'ccw3' => $ccw3,
                ]);
                $detailCount++;
            }
        }

        // ==================================================================
        // 4. SIMPAN ADD TORQUE METER — Tetap sama
        // ==================================================================
        $addData = [
            'calibration_id' => $calibration->id,
            'repCw01' => $request->repeat_cw_1 ?? null,
            'repCw02' => $request->repeat_cw_2 ?? null,
            'repCw03' => $request->repeat_cw_3 ?? null,
            'repCw04' => $request->repeat_cw_4 ?? null,
            'repCw05' => $request->repeat_cw_5 ?? null,
            'repCw06' => $request->repeat_cw_6 ?? null,
            'repCw07' => $request->repeat_cw_7 ?? null,
            'repCw08' => $request->repeat_cw_8 ?? null,
            'repCw09' => $request->repeat_cw_9 ?? null,
            'repCw10' => $request->repeat_cw_10 ?? null,
            'repCcw01' => $request->repeat_ccw_1 ?? null,
            'repCcw02' => $request->repeat_ccw_2 ?? null,
            'repCcw03' => $request->repeat_ccw_3 ?? null,
            'repCcw04' => $request->repeat_ccw_4 ?? null,
            'repCcw05' => $request->repeat_ccw_5 ?? null,
            'repCcw06' => $request->repeat_ccw_6 ?? null,
            'repCcw07' => $request->repeat_ccw_7 ?? null,
            'repCcw08' => $request->repeat_ccw_8 ?? null,
            'repCcw09' => $request->repeat_ccw_9 ?? null,
            'repCcw10' => $request->repeat_ccw_10 ?? null,
            'radiusAlatBantuSTD' => $request->radius_value ?? null,
            'kodeAlatBantuSTD'   => $request->radius_unit ?? null,
        ];

        $hasData = collect($addData)->except('calibration_id')->filter()->isNotEmpty();
        if ($hasData) {
            AddTorqueMeter::create($addData);
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION (nama_dikalibrasi & nama_diperiksa)
        // ==================================================================
        $updateData = [];
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }

        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        \Log::info('storeTorqueMeter COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('ERROR storeTorqueMeter:', [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
        ]);

        if (isset($head)) {
            DetailTorqueMeter::where('calibration_id', $calibration->id)->delete();
            AddTorqueMeter::where('calibration_id', $calibration->id)->delete();
            $head->delete();
        }

        throw $e;
    }
}

private function updateTorqueMeter($request, $calibration)
{
    \Log::channel('calibration')->info('🚀 ===== START updateTorqueMeter =====', [
        'calibration_id' => $calibration->id,
        'certificate_id' => $calibration->headTorqueWrench->certificate_id ?? 'N/A',
        'timestamp' => now()->toDateTimeString()
    ]);
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR & HEAD DATA
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::channel('calibration')->info('🔧 ALAT STANDAR UPDATE:', [
            'count' => count($alatStandar),
            'items' => $alatStandar,
            'string_value' => $alatStandarString,
            'old_value' => $calibration->headTorqueWrench->standard ?? 'null'
        ]);

        // Update atau create head data
        if ($head = $calibration->headTorqueWrench) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1101-01 (ISO 6789-1:2017; SNSU PK.P-01:2020)',
                'clockwise_unit' => $request->clockwise_unit ?? null,
                'counter_clockwise_unit' => $request->counter_clockwise_unit ?? null,
                'nominal_unit' => $request->nominal_unit ?? null,
            ]);
            
            \Log::channel('calibration')->info('✅ HEAD DATA UPDATED:', [
                'head_id' => $head->id,
                'standard_updated' => true,
                'method_updated' => true,
                'clockwise_unit' => $request->clockwise_unit,
                'counter_clockwise_unit' => $request->counter_clockwise_unit,
                'nominal_unit' => $request->nominal_unit,
            ]);
        } else {
            \Log::channel('calibration')->warning('⚠️ NO HEAD DATA FOUND, creating new...');
            
            $head = HeadTorqueWrench::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1101-01 (ISO 6789-1:2017; SNSU PK.P-01:2020)',
                'clockwise_unit' => $request->clockwise_unit ?? null,
                'counter_clockwise_unit' => $request->counter_clockwise_unit ?? null,
                'nominal_unit' => $request->nominal_unit ?? null,
            ]);
            
            \Log::channel('calibration')->info('➕ NEW HEAD CREATED:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL MEASUREMENTS (13 baris dari torque[0] sampai torque[12])
        // ==================================================================
        \Log::channel('calibration')->info('📊 DETAIL MEASUREMENTS UPDATE:', [
            'old_records_count' => DetailTorqueMeter::where('calibration_id', $calibration->id)->count(),
            'torque_data_count' => is_array($request->torque) ? count($request->torque) : 0
        ]);
        
        // Log sample of incoming data
        if (is_array($request->torque) && count($request->torque) > 0) {
            \Log::channel('calibration')->debug('📝 INCOMING TORQUE DATA SAMPLE:', [
                'first_row' => $request->torque[0] ?? [],
                'last_row' => $request->torque[12] ?? [],
                'total_rows' => count($request->torque)
            ]);
        }
        
        // Hapus data detail lama
        $deletedCount = DetailTorqueMeter::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD DETAIL DATA DELETED:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru - 13 BARIS (sesuai dengan input HTML)
        $detailCount = 0;
        $errors = [];
        
        for ($i = 0; $i < 13; $i++) {
            $torqueData = $request->torque[$i] ?? [];
            
            // Check if row has data (semua field boleh kosong)
            $hasData = !empty($torqueData) && (
                !empty(trim($torqueData['titikUkurBeban'] ?? '')) || 
                !empty(trim($torqueData['kodeStandard'] ?? '')) || 
                !empty(trim($torqueData['cw1'] ?? '')) || 
                !empty(trim($torqueData['cw2'] ?? '')) || 
                !empty(trim($torqueData['cw3'] ?? '')) || 
                !empty(trim($torqueData['ccw1'] ?? '')) || 
                !empty(trim($torqueData['ccw2'] ?? '')) || 
                !empty(trim($torqueData['ccw3'] ?? ''))
            );
            
            if ($hasData) {
                try {
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkurBeban' => $this->formatNumericValue($torqueData['titikUkurBeban'] ?? null),
                        'kodeStandard' => $torqueData['kodeStandard'] ?? null,
                        'cw1' => $this->formatNumericValue($torqueData['cw1'] ?? null),
                        'cw2' => $this->formatNumericValue($torqueData['cw2'] ?? null),
                        'cw3' => $this->formatNumericValue($torqueData['cw3'] ?? null),
                        'ccw1' => $this->formatNumericValue($torqueData['ccw1'] ?? null),
                        'ccw2' => $this->formatNumericValue($torqueData['ccw2'] ?? null),
                        'ccw3' => $this->formatNumericValue($torqueData['ccw3'] ?? null),
                    ];
                    
                    \Log::channel('calibration')->debug("💾 SAVING TORQUE ROW {$i}:", [
                        'row' => $i,
                        'data' => $detailData
                    ]);
                    
                    DetailTorqueMeter::create($detailData);
                    $detailCount++;
                    
                } catch (\Exception $rowError) {
                    $errors[] = "Row {$i}: " . $rowError->getMessage();
                    \Log::channel('calibration')->error("❌ TORQUE ROW {$i} SAVE ERROR:", [
                        'error' => $rowError->getMessage(),
                        'data' => $torqueData
                    ]);
                }
            } else {
                \Log::channel('calibration')->debug("⏭️ SKIPPING EMPTY TORQUE ROW {$i}");
            }
        }
        
        \Log::channel('calibration')->info("✅ DETAIL TORQUE DATA SAVED:", [
            'total_records' => $detailCount,
            'errors_count' => count($errors),
            'errors' => $errors
        ]);

        // ==================================================================
        // 3. UPDATE ADDITIONAL DATA (AddTorqueWrench)
        // ==================================================================
        \Log::channel('calibration')->info('📊 ADDITIONAL DATA UPDATE:');
        
        // Hapus data additional lama
        $deletedAddCount = AddTorqueWrench::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD ADDITIONAL DATA DELETED:', ['deleted_count' => $deletedAddCount]);
        
        // Simpan data additional baru
        $addData = [
            'calibration_id' => $calibration->id,
        ];
        
        // Data Repeatability Clockwise (repCw01 - repCw10)
        for ($i = 1; $i <= 10; $i++) {
            $fieldName = 'repCw' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $value = $this->formatNumericValue($request->{$fieldName} ?? null);
            if ($value !== null) {
                $addData[$fieldName] = $value;
            }
        }
        
        // Data Repeatability Counter Clockwise (repCcw01 - repCcw10)
        for ($i = 1; $i <= 10; $i++) {
            $fieldName = 'repCcw' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $value = $this->formatNumericValue($request->{$fieldName} ?? null);
            if ($value !== null) {
                $addData[$fieldName] = $value;
            }
        }
        
        // Filter hanya field yang ada di fillable model
        $fillable = (new AddTorqueWrench())->getFillable();
        $filteredData = ['calibration_id' => $calibration->id];
        
        foreach ($addData as $key => $value) {
            if (($value !== null) && (in_array($key, $fillable) || $key === 'calibration_id')) {
                $filteredData[$key] = $value;
            }
        }
        
        try {
            if (count($filteredData) > 1) { // lebih dari hanya calibration_id
                AddTorqueWrench::create($filteredData);
                \Log::channel('calibration')->info('✅ ADDITIONAL DATA SAVED:', [
                    'total_fields' => count($filteredData),
                    'sample_cw' => [
                        'repCw01' => $filteredData['repCw01'] ?? null, 
                        'repCw02' => $filteredData['repCw02'] ?? null
                    ],
                    'sample_ccw' => [
                        'repCcw01' => $filteredData['repCcw01'] ?? null, 
                        'repCcw02' => $filteredData['repCcw02'] ?? null
                    ]
                ]);
            } else {
                \Log::channel('calibration')->info('⏭️ NO ADDITIONAL DATA TO SAVE');
            }
        } catch (\Exception $addError) {
            \Log::channel('calibration')->error('❌ ADDITIONAL DATA SAVE ERROR:', [
                'error' => $addError->getMessage(),
                'data_sample' => array_slice($filteredData, 0, 5)
            ]);
            throw $addError;
        }

        // ==================================================================
        // 4. VERIFY SAVED DATA
        // ==================================================================
        $savedDetails = DetailTorqueMeter::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::channel('calibration')->info('🔍 VERIFY SAVED TORQUE DATA:', [
            'total_saved' => $savedDetails->count(),
            'first_3_rows_sample' => $savedDetails->take(3)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkurBeban' => $item->titikUkurBeban,
                    'kodeStandard' => $item->kodeStandard,
                    'cw1' => $item->cw1,
                    'cw2' => $item->cw2,
                    'cw3' => $item->cw3,
                    'ccw1' => $item->ccw1,
                    'created_at' => $item->created_at
                ];
            })->toArray()
        ]);

        // ==================================================================
        // 5. UPDATE CALIBRATION ADDITIONAL DATA
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibratedBy')) {
            $updateData['calibrated_by'] = $request->calibratedBy;
        }
        
        if ($request->filled('verifiedBy')) {
            $updateData['verified_by'] = $request->verifiedBy;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Tambahan khusus untuk Torque Meter
        if ($request->filled('unit')) {
            $updateData['unit'] = $request->unit;
        }
        
        if ($request->filled('temperature')) {
            $updateData['temperature'] = $request->temperature;
        }
        
        if ($request->filled('humidity')) {
            $updateData['humidity'] = $request->humidity;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::channel('calibration')->info('📝 CALIBRATION ADDITIONAL DATA UPDATED:', $updateData);
        }

        // ==================================================================
        // 6. FINAL SUMMARY
        // ==================================================================
        $finalDetailCount = DetailTorqueMeter::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddTorqueWrench::where('calibration_id', $calibration->id)->count();
        
        \Log::channel('calibration')->info('📋 UPDATE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'certificate_id' => $head->certificate_id ?? 'N/A',
            'detail_records' => $finalDetailCount,
            'additional_records' => $finalAddCount,
            'alat_standar' => $alatStandarString,
            'clockwise_unit' => $head->clockwise_unit,
            'counter_clockwise_unit' => $head->counter_clockwise_unit,
            'nominal_unit' => $head->nominal_unit,
            'calibrated_by' => $calibration->calibrated_by,
            'verified_by' => $calibration->verified_by,
            'unit' => $calibration->unit,
            'temperature' => $calibration->temperature,
            'humidity' => $calibration->humidity,
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_peak' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);

        \Log::channel('calibration')->info('🎉 updateTorqueMeter COMPLETED SUCCESSFULLY');
        return true;

    } catch (\Exception $e) {
        \Log::channel('calibration')->error('💥 updateTorqueMeter FAILED:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}

private function storeThicknessGauge($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeThicknessGauge');
        
        // ==================================================================
        // 1. ALAT STANDAR - NILAI TETAP (TIDAK ADA INPUT DARI FORM)
        // ==================================================================
        $alatStandarValue = 'Gauge Block Set Grade 0'; // NILAI TETAP
        
        \Log::info('🔧 Alat standar (fixed value):', ['alat_standar' => $alatStandarValue]);

        // ==================================================================
        // 2. SIMPAN KE HEAD THICKNESS GAUGE
        // ==================================================================
        $head = HeadThicknessGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarValue, // NILAI TETAP
            'calibrationMethod' => 'PAS-IK1102-21',
        ]);

        \Log::info('✅ HeadThicknessGauge saved:', ['head_id' => $head->id, 'standard' => $alatStandarValue]);

        // ==================================================================
        // 3. SIMPAN DETAIL MEASUREMENTS (17 NILAI: 0.0 - 50.0)
        // ==================================================================
        \Log::info('📊 Saving Thickness Gauge detail measurements...');
        $detailCount = 0;
        
        // Array semua nilai nominal yang ada dalam form
        $nominalValues = ['0.0', '0.5', '1.0', '2.0', '3.0', '4.0', '5.0', '6.0', '7.0', '8.0', '9.0', '10.0', '15.0', '20.0', '30.0', '40.0', '50.0'];
        
        foreach ($nominalValues as $nominal) {
            // Normalisasi nama field (ganti titik dengan underscore)
            $fieldSuffix = str_replace('.', '_', $nominal);
            
            // AMBIL DATA ULANGAN (5 kolom) - HANYA INI YANG DARI INPUT FORM
            $ulangan01 = $request->{"ulangan_{$fieldSuffix}_1"} ?? null;
            $ulangan02 = $request->{"ulangan_{$fieldSuffix}_2"} ?? null;
            $ulangan03 = $request->{"ulangan_{$fieldSuffix}_3"} ?? null;
            $ulangan04 = $request->{"ulangan_{$fieldSuffix}_4"} ?? null;
            $ulangan05 = $request->{"ulangan_{$fieldSuffix}_5"} ?? null;
            
            \Log::debug("📝 Data ulangan untuk nominal {$nominal}:", [
                'ulangan_1' => $ulangan01,
                'ulangan_2' => $ulangan02,
                'ulangan_3' => $ulangan03,
                'ulangan_4' => $ulangan04,
                'ulangan_5' => $ulangan05,
            ]);
            
            // Validasi: Simpan hanya jika ada minimal satu data ulangan
            $hasUlangan = !empty($ulangan01) || !empty($ulangan02) || !empty($ulangan03) || 
                         !empty($ulangan04) || !empty($ulangan05);
            
            if ($hasUlangan) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $nominal, // NILAI NOMINAL LANGSUNG
                    'ulangan01' => $this->formatNumericValue($ulangan01),
                    'ulangan02' => $this->formatNumericValue($ulangan02),
                    'ulangan03' => $this->formatNumericValue($ulangan03),
                    'ulangan04' => $this->formatNumericValue($ulangan04),
                    'ulangan05' => $this->formatNumericValue($ulangan05),
                ];
                
                \Log::info("💾 Saving detail for nominal {$nominal}:", $detailData);
                
                DetailThicknessGauge::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detail measurements for Thickness Gauge");

        // ==================================================================
        // 4. SIMPAN DATA TAMBAHAN (TTD, NAMA, TANGGAL)
        // ==================================================================
        // Update calibration dengan data TTD dan nama
        $updateData = [];
        
        // Nama untuk TTD Dikalibrasi
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->nama_dikalibrasi]);
        }
        
        // TTD Dikalibrasi
        if ($request->filled('ttd_dikalibrasi')) {
            \Log::info('✍️ TTD dikalibrasi:', ['ttd' => $request->ttd_dikalibrasi]);
        }
        
        // Tanggal Dikalibrasi
        if ($request->filled('tanggal_dikalibrasi')) {
            \Log::info('📅 Tanggal dikalibrasi:', ['tanggal' => $request->tanggal_dikalibrasi]);
        }
        
        // Nama untuk TTD Diperiksa
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->nama_diperiksa]);
        }
        
        // TTD Diperiksa
        if ($request->filled('ttd_diperiksa')) {
            \Log::info('✍️ TTD diperiksa:', ['ttd' => $request->ttd_diperiksa]);
        }
        
        // Tanggal Diperiksa
        if ($request->filled('tanggal_diperiksa')) {
            \Log::info('📅 Tanggal diperiksa:', ['tanggal' => $request->tanggal_diperiksa]);
        }
        
        // Update calibration jika ada data
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailThicknessGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarValue,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storeThicknessGauge COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeThicknessGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailThicknessGauge::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Thickness Gauge: " . $e->getMessage());
    }
}

/**
 * Format nilai numerik - untuk handling koma/point
 */
private function formatNumericValue($value)
{
    if (empty($value) || $value === null || $value === '') {
        return null;
    }
    
    // Jika sudah numeric, langsung return
    if (is_numeric($value)) {
        return (float) $value;
    }
    
    // Ganti koma dengan titik
    $value = str_replace(',', '.', $value);
    
    // Cek lagi apakah numeric
    return is_numeric($value) ? (float) $value : null;
}

/**
 * Update Thickness Gauge data - VERSI SIMPLE (ALAT STANDAR TETAP)
 */
private function updateThicknessGauge($request, $calibration)
{
    try {
        \Log::info('🚀 START updateThicknessGauge');
        
        // ==================================================================
        // 1. UPDATE HEAD THICKNESS GAUGE - NILAI TETAP
        // ==================================================================
        $alatStandarValue = 'Gauge Block Set Grade 0'; // NILAI TETAP
        
        if ($head = $calibration->headThicknessGauge) {
            $head->update([
                'standard' => $alatStandarValue, // UPDATE DENGAN NILAI TETAP
            ]);
            
            \Log::info('✅ HeadThicknessGauge updated', [
                'id' => $head->id,
                'standard' => $alatStandarValue,
            ]);
        } else {
            $head = HeadThicknessGauge::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarValue, // NILAI TETAP
                'calibrationMethod' => 'PAS-IK1102-21',
            ]);
            
            \Log::info('➕ HeadThicknessGauge created baru', [
                'id' => $head->id,
                'calibration_id' => $calibration->id
            ]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL MEASUREMENTS (DELETE & RECREATE)
        // ==================================================================
        \Log::info('🔄 Updating detail measurements...');
        
        // Hapus data detail lama
        $deletedCount = DetailThicknessGauge::where('calibration_id', $calibration->id)->delete();
        \Log::info('🗑️ Data lama dihapus', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru
        $detailCount = 0;
        $nominalValues = ['0.0', '0.5', '1.0', '2.0', '3.0', '4.0', '5.0', '6.0', '7.0', '8.0', '9.0', '10.0', '15.0', '20.0', '30.0', '40.0', '50.0'];
        
        foreach ($nominalValues as $nominal) {
            $fieldSuffix = str_replace('.', '_', $nominal);
            
            // Ambil data ulangan dari form
            $ulangan01 = $request->{"ulangan_{$fieldSuffix}_1"} ?? null;
            $ulangan02 = $request->{"ulangan_{$fieldSuffix}_2"} ?? null;
            $ulangan03 = $request->{"ulangan_{$fieldSuffix}_3"} ?? null;
            $ulangan04 = $request->{"ulangan_{$fieldSuffix}_4"} ?? null;
            $ulangan05 = $request->{"ulangan_{$fieldSuffix}_5"} ?? null;
            
            // Validasi: Simpan hanya jika ada minimal satu data ulangan
            $hasUlangan = !empty($ulangan01) || !empty($ulangan02) || !empty($ulangan03) || 
                         !empty($ulangan04) || !empty($ulangan05);
            
            if ($hasUlangan) {
                DetailThicknessGauge::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $nominal, // NILAI NOMINAL LANGSUNG
                    'ulangan01' => $this->formatNumericValue($ulangan01),
                    'ulangan02' => $this->formatNumericValue($ulangan02),
                    'ulangan03' => $this->formatNumericValue($ulangan03),
                    'ulangan04' => $this->formatNumericValue($ulangan04),
                    'ulangan05' => $this->formatNumericValue($ulangan05),
                ]);
                
                $detailCount++;
            }
        }
        
        \Log::info('✅ Detail measurements updated', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('📝 Calibration updated', $updateData);
        }

        // ==================================================================
        // 4. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailThicknessGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'standard' => $alatStandarValue,
        ]);

        \Log::info('🎉 updateThicknessGauge COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateThicknessGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}


private function storePenggaris($request, $calibration, $certificateId)
{
    try {
        
        
        $alatStandarValue = 'Reading Glass Scale, Metrology, OP-RS410/A'; // NILAI TETAP
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandarValue]);

        // Simpan ke Head Inside Micrometer
        $head = HeadPenggaris::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarValue,
            'calibrationMethod' => 'PAS-IK1102-28',
        ]);

        \Log::info('✅ Head Inside Micrometer saved:', ['head_id' => $head->id]);

        // Simpan detail measurements
        \Log::info('📊 Saving detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 16; $i++) {
            if ($request->has("nominal_$i") && !empty($request->{"nominal_$i"})) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $request->{"nominal_$i"},
                    'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                    'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                    'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                    'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                    'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                ];

                \Log::info("📝 Saving detail row $i:", $detailData);
                
                DetailPenggaris::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Inside Micrometer data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

private function updatePenggaris($request, $calibration)
    {
        if ($calibration->headPenggaris) {
            $calibration->headPenggaris->update([
                'standard' => implode(', ', $request->alat_standar ?? []),
            ]);

            // Update details
            $details = $calibration->headPenggaris->details;
            $i = 1;
            foreach ($details as $detail) {
                if ($request->has("nominal_$i")) {
                    $detail->update([
                        'titikUkur' => $request->{"nominal_$i"},
                        'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                        'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                        'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                        'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                        'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                    ]);
                }
                $i++;
            }
        }
    }


    private function storeEnclosure($request, $calibration, $certificateId)
    {
        try {
            \Log::info('🚀 START storeEnclosure - MULTIPLE REPETITION');
            
            // ==================================================================
            // 1. TENTUKAN JUMLAH PENGULANGAN
            // ==================================================================
            // Cari jumlah pengulangan dari request
            $repetition = 1; // Default 1 kali
            for ($i = 1; $i <= 3; $i++) {
                if ($request->filled("suhu_setting_$i")) {
                    $repetition = $i; // Update ke pengulangan terakhir yang ada
                }
            }
            
            \Log::info('📊 Jumlah pengulangan:', ['repetition' => $repetition]);
            
            // ==================================================================
            // 2. PROSES ALAT STANDAR
            // ==================================================================
            $textValue = trim($request->alat_standar_text ?? '');
            $arrayValue = $request->input('alat_standar', []);
            
            if (!empty($textValue)) {
                $standardValue = $textValue;
            } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
                $standardValue = implode("\n", $arrayValue);
            } else {
                $standardValue = '';
            }
            
            \Log::info('🔧 Alat standar selected:', [
                'textarea' => $textValue,
                'checkbox_array' => $arrayValue,
                'saved_to_db' => $standardValue
            ]);
            
            // ==================================================================
            // 3. SIMPAN KE HEAD ENCLOSURE
            // ==================================================================
            $head = HeadEnclosure::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $certificateId,
                'standard' => $standardValue,
                'calibrationMethod' => 'PAS-IK1102-29 (SNSU PK.P-29:2020)',
            ]);
            
            \Log::info('✅ HeadEnclosure saved:', ['head_id' => $head->id]);
            
            // ==================================================================
            // 4. SIMPAN KE ADD ENCLOSURE UNTUK SETIAP PENGULANGAN
            // ==================================================================
            \Log::info('📊 Saving AddEnclosure data for each repetition...');
            
            // INTERVAL YANG BENAR: 1,2,3,4,5,13,20,30
            $allIntervals = [1, 2, 3, 4, 5, 13, 20, 30];
            $intervalJson = json_encode($allIntervals); // [1,2,3,4,5,13,20,30]
            
            // Simpan setiap pengulangan sebagai record terpisah
            for ($p = 1; $p <= $repetition; $p++) {
                // Ambil Tsetting dari input suhu_setting_p
                $tsettingValue = null;
                $fieldName = "suhu_setting_$p";
                if ($request->filled($fieldName)) {
                    $tsettingValue = (float) str_replace(',', '.', $request->$fieldName);
                }
                
                $tsettingJson = $tsettingValue !== null ? json_encode(['value' => $tsettingValue]) : null;
                
                \Log::debug("📝 AddEnclosure data for repetition {$p}:", [
                    'suhu_setting' => $request->$fieldName ?? 'null',
                    'Tsetting_value' => $tsettingValue,
                ]);
                
                // Simpan ke AddEnclosure dengan kolom repetition_number
                try {
                    AddEnclosure::create([
                        'calibration_id' => $calibration->id,
                        'repetition_number' => $p, // Kolom baru untuk identifikasi pengulangan
                        'Tsetting' => $tsettingJson,
                        'Interval' => $intervalJson,
                    ]);
                    \Log::info("✅ AddEnclosure saved for repetition {$p}");
                } catch (\Exception $e) {
                    \Log::warning("⚠️ AddEnclosure save failed for repetition {$p}:", [
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            // ==================================================================
            // 5. SIMPAN DETAIL ENCLOSURE UNTUK SETIAP PENGULANGAN
            // ==================================================================
            \Log::info('📊 Saving DetailEnclosure data for each repetition...');
            $totalDetailCount = 0;
            
            for ($p = 1; $p <= $repetition; $p++) {
                $detailCount = 0;
                
                foreach ($allIntervals as $interval) {
                    // Ambil data sensor untuk 9 kolom dengan prefix pengulangan
                    $sensorData = [];
                    $hasSensorData = false;
                    
                    for ($col = 1; $col <= 9; $col++) {
                        $fieldName = "sensor_{$p}_{$interval}_{$col}";
                        $rawValue = $request->{$fieldName} ?? null;
                        
                        $sensorData[$col] = ($rawValue !== null && $rawValue !== '') 
                            ? (float) str_replace(',', '.', $rawValue) 
                            : null;
                        
                        if ($sensorData[$col] !== null) {
                            $hasSensorData = true;
                        }
                    }
                    
                    // Ambil nilai alat dengan prefix pengulangan
                    $alatField = "alat_{$p}_{$interval}";
                    $alatValue = $request->{$alatField} ?? null;
                    $hasAlatData = ($alatValue !== null && $alatValue !== '');
                    
                    // Simpan detail jika ada data sensor ATAU alat
                    if ($hasSensorData || $hasAlatData) {
                        $detailData = [
                            'calibration_id' => $calibration->id,
                            'repetition_number' => $p, // Kolom baru untuk identifikasi pengulangan
                            'interval_number' => $interval, // Simpan interval juga
                            'readAlat' => ($alatValue !== null && $alatValue !== '') 
                                ? (float) str_replace(',', '.', $alatValue) 
                                : null,
                            'readSensor1' => $sensorData[1] ?? null,
                            'readSensor2' => $sensorData[2] ?? null,
                            'readSensor3' => $sensorData[3] ?? null,
                            'readSensor4' => $sensorData[4] ?? null,
                            'readSensor5' => $sensorData[5] ?? null,
                            'readSensor6' => $sensorData[6] ?? null,
                            'readSensor7' => $sensorData[7] ?? null,
                            'readSensor8' => $sensorData[8] ?? null,
                            'readSensor9' => $sensorData[9] ?? null,
                        ];
                        
                        \Log::debug("💾 Saving DetailEnclosure for repetition {$p}, interval {$interval}");
                        
                        DetailEnclosure::create($detailData);
                        $detailCount++;
                        $totalDetailCount++;
                    } else {
                        \Log::debug("⏭️ Skipping repetition {$p}, interval {$interval} - no data");
                    }
                }
                
                \Log::info("✅ Saved {$detailCount} DetailEnclosure records for repetition {$p}");
            }
            
            \Log::info("✅ Saved {$totalDetailCount} DetailEnclosure records total (for {$repetition} repetitions)");
            
            // ==================================================================
            // 6. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
            // ==================================================================
            $updateData = [];
            
            if ($request->filled('nama_dikalibrasi')) {
                $updateData['calibrated_by'] = $request->nama_dikalibrasi;
            }
            
            if ($request->filled('nama_diperiksa')) {
                $updateData['verified_by'] = $request->nama_diperiksa;
            }
            
            if ($request->filled('uncertainty')) {
                $updateData['uncertainty'] = $request->uncertainty;
                $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
            }
            
            if (!empty($updateData)) {
                $calibration->update($updateData);
                \Log::info('📝 Calibration updated with additional data');
            }
            
            // ==================================================================
            // 7. LOG HASIL AKHIR
            // ==================================================================
            $savedDetailCount = DetailEnclosure::where('calibration_id', $calibration->id)->count();
            $savedAddCount = AddEnclosure::where('calibration_id', $calibration->id)->count();
            
            \Log::info('📋 STORE SUMMARY (MULTIPLE REPETITION):', [
                'calibration_id' => $calibration->id,
                'repetition_count' => $repetition,
                'detail_records' => $savedDetailCount,
                'add_records' => $savedAddCount,
                'expected_rows' => $repetition * count($allIntervals),
                'intervals_per_repetition' => $allIntervals,
                'certificate_id' => $certificateId,
                'standard' => $standardValue,
                'calibrated_by' => $calibration->calibrated_by ?? null,
                'verified_by' => $calibration->verified_by ?? null,
            ]);
            
            \Log::info('🎉 storeEnclosure COMPLETED (Multiple Repetition)');
            return true;
            
        } catch (\Exception $e) {
            \Log::error('💥 ERROR storeEnclosure (Multiple Repetition):', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'calibration_id' => $calibration->id ?? 'N/A',
            ]);
            
            // Rollback sederhana
            if (isset($head) && $head->id) {
                try {
                    DetailEnclosure::where('calibration_id', $calibration->id)->delete();
                    AddEnclosure::where('calibration_id', $calibration->id)->delete();
                    $head->delete();
                } catch (\Exception $rollbackError) {
                    \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
                }
            }
            
            throw new \Exception("Gagal menyimpan data Enclosure: " . $e->getMessage());
        }
    }
    
    private function updateEnclosure($request, $calibration)
    {
        try {
            \Log::info('🚀 START updateEnclosure - MULTIPLE REPETITION');
            
            // ==================================================================
            // 1. TENTUKAN JUMLAH PENGULANGAN
            // ==================================================================
            $repetition = 1; // Default 1 kali
            for ($i = 1; $i <= 3; $i++) {
                if ($request->filled("suhu_setting_$i")) {
                    $repetition = $i;
                }
            }
            
            \Log::info('📊 Jumlah pengulangan:', ['repetition' => $repetition]);
            
            // INTERVAL YANG BENAR: 1,2,3,4,5,13,20,30
            $allIntervals = [1, 2, 3, 4, 5, 13, 20, 30];
            
            // ==================================================================
            // 2. UPDATE HEAD ENCLOSURE
            // ==================================================================
            $textValue = trim($request->alat_standar_text ?? '');
            $arrayValue = $request->input('alat_standar', []);
            
            if (!empty($textValue)) {
                $standardValue = $textValue;
            } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
                $standardValue = implode("\n", $arrayValue);
            } else {
                $standardValue = '';
            }
            
            if ($head = $calibration->headEnclosure) {
                $head->update([
                    'standard' => $standardValue,
                ]);
                \Log::info('✅ HeadEnclosure updated', ['standard' => $standardValue]);
            } else {
                $head = HeadEnclosure::create([
                    'calibration_id' => $calibration->id,
                    'certificate_id' => $calibration->certificate_id ?? null,
                    'standard' => $standardValue,
                    'calibrationMethod' => 'PAS-IK1102-29 (SNSU PK.P-29:2020)',
                ]);
                \Log::info('➕ HeadEnclosure created baru', ['id' => $head->id]);
            }
            
            // ==================================================================
            // 3. UPDATE ADD ENCLOSURE (DELETE & RECREATE)
            // ==================================================================
            \Log::info('📊 Updating AddEnclosure data for each repetition...');
            
            // Hapus data AddEnclosure lama
            AddEnclosure::where('calibration_id', $calibration->id)->delete();
            
            $intervalJson = json_encode($allIntervals); // [1,2,3,4,5,13,20,30]
            
            // Simpan setiap pengulangan sebagai record terpisah
            for ($p = 1; $p <= $repetition; $p++) {
                $tsettingValue = null;
                $fieldName = "suhu_setting_$p";
                if ($request->filled($fieldName)) {
                    $tsettingValue = (float) str_replace(',', '.', $request->$fieldName);
                }
                
                $tsettingJson = $tsettingValue !== null ? json_encode(['value' => $tsettingValue]) : null;
                
                AddEnclosure::create([
                    'calibration_id' => $calibration->id,
                    'repetition_number' => $p,
                    'Tsetting' => $tsettingJson,
                    'Interval' => $intervalJson,
                ]);
                
                \Log::info("✅ AddEnclosure saved for repetition {$p}");
            }
            
            // ==================================================================
            // 4. UPDATE DETAIL ENCLOSURE (DELETE & RECREATE)
            // ==================================================================
            // Hapus data detail lama
            DetailEnclosure::where('calibration_id', $calibration->id)->delete();
            
            $totalDetailCount = 0;
            
            for ($p = 1; $p <= $repetition; $p++) {
                $detailCount = 0;
                
                foreach ($allIntervals as $interval) {
                    // Ambil sensor data dengan prefix pengulangan
                    $sensorData = [];
                    for ($col = 1; $col <= 9; $col++) {
                        $fieldName = "sensor_{$p}_{$interval}_{$col}";
                        $rawValue = $request->{$fieldName} ?? null;
                        $sensorData[$col] = ($rawValue !== null && $rawValue !== '') 
                            ? (float) str_replace(',', '.', $rawValue) 
                            : null;
                    }
                    
                    // Ambil alat data dengan prefix pengulangan
                    $alatField = "alat_{$p}_{$interval}";
                    $alatValue = $request->{$alatField} ?? null;
                    
                    // Cek apakah ada data
                    $hasSensorData = !empty(array_filter($sensorData, function($val) { 
                        return $val !== null; 
                    }));
                    
                    $hasAlatData = ($alatValue !== null && $alatValue !== '');
                    
                    if ($hasSensorData || $hasAlatData) {
                        DetailEnclosure::create([
                            'calibration_id' => $calibration->id,
                            'repetition_number' => $p,
                            'interval_number' => $interval,
                            'readAlat' => ($alatValue !== null && $alatValue !== '') 
                                ? (float) str_replace(',', '.', $alatValue) 
                                : null,
                            'readSensor1' => $sensorData[1] ?? null,
                            'readSensor2' => $sensorData[2] ?? null,
                            'readSensor3' => $sensorData[3] ?? null,
                            'readSensor4' => $sensorData[4] ?? null,
                            'readSensor5' => $sensorData[5] ?? null,
                            'readSensor6' => $sensorData[6] ?? null,
                            'readSensor7' => $sensorData[7] ?? null,
                            'readSensor8' => $sensorData[8] ?? null,
                            'readSensor9' => $sensorData[9] ?? null,
                        ]);
                        
                        $detailCount++;
                        $totalDetailCount++;
                    }
                }
                
                \Log::info("✅ Saved {$detailCount} DetailEnclosure records for repetition {$p}");
            }
            
            \Log::info('✅ DetailEnclosure updated', [
                'total_records' => $totalDetailCount,
                'repetition_count' => $repetition,
                'expected_records' => $repetition * count($allIntervals),
            ]);
            
            // ==================================================================
            // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
            // ==================================================================
            $updateData = [];
            
            if ($request->filled('nama_dikalibrasi')) {
                $updateData['calibrated_by'] = $request->nama_dikalibrasi;
            }
            
            if ($request->filled('nama_diperiksa')) {
                $updateData['verified_by'] = $request->nama_diperiksa;
            }
            
            if ($request->filled('uncertainty')) {
                $updateData['uncertainty'] = $request->uncertainty;
                $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
            }
            
            if (!empty($updateData)) {
                $calibration->update($updateData);
            }
            
            // ==================================================================
            // 6. LOG HASIL AKHIR
            // ==================================================================
            $finalDetailCount = DetailEnclosure::where('calibration_id', $calibration->id)->count();
            $finalAddCount = AddEnclosure::where('calibration_id', $calibration->id)->count();
            
            \Log::info('📋 UPDATE SUMMARY (MULTIPLE REPETITION):', [
                'calibration_id' => $calibration->id,
                'repetition_count' => $repetition,
                'detail_records' => $finalDetailCount,
                'add_records' => $finalAddCount,
                'expected_detail' => $repetition * count($allIntervals),
                'intervals' => $allIntervals,
                'standard' => $standardValue,
                'calibrated_by' => $calibration->calibrated_by ?? null,
                'verified_by' => $calibration->verified_by ?? null,
            ]);
            
            \Log::info('🎉 updateEnclosure COMPLETED (Multiple Repetition)');
            return true;
            
        } catch (\Exception $e) {
            \Log::error('💥 ERROR updateEnclosure (Multiple Repetition):', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }

    private function storeClimaticChamber($request, $calibration, $certificateId)
    {
        try {
            \Log::info('🚀 START storeClimaticChamber - SESUAI MODEL LAMA');
            
            // ==================================================================
            // 1. TENTUKAN JUMLAH PENGULANGAN
            // ==================================================================
            $repetition = 1;
            for ($i = 1; $i <= 3; $i++) {
                if ($request->filled("suhu_setting_$i")) {
                    $repetition = $i;
                }
            }
            
            \Log::info('📊 Jumlah pengulangan:', ['repetition' => $repetition]);
            
            // ==================================================================
            // 2. PROSES ALAT STANDAR
            // ==================================================================
            $textValue = trim($request->alat_standar_text ?? '');
            $arrayValue = $request->input('alat_standar', []);
            
            if (!empty($textValue)) {
                $standardValue = $textValue;
            } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
                $standardValue = implode("\n", $arrayValue);
            } else {
                $standardValue = '';
            }
            
            \Log::info('🔧 Alat standar selected:', ['saved_to_db' => $standardValue]);
            
            // ==================================================================
            // 3. SIMPAN KE HEAD CHAMBER
            // ==================================================================
            $head = HeadChamber::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $certificateId,
                'standard' => $standardValue,
                'calibrationMethod' => 'PAS-IK1102-29B',
            ]);
            
            \Log::info('✅ HeadChamber saved:', ['head_id' => $head->id]);
            
            // ==================================================================
            // 4. SIMPAN DETAIL CHAMBER - SESUAI MODEL LAMA
            // ==================================================================
            \Log::info('📊 Saving DetailChamber data (OLD MODEL STRUCTURE)...');
            $totalDetailCount = 0;
            
            $allIntervals = [1, 2, 3, 4, 5, 13, 20, 30];
            
            // ✅ SIMPAN SETIAP PENGULANGAN SEBAGAI RECORD TERPISAH
            for ($p = 1; $p <= $repetition; $p++) {
                $detailCount = 0;
                
                foreach ($allIntervals as $interval) {
                    // Ambil data dari form dengan nama field yang berbeda
                    $alatCField = "alat_{$p}_{$interval}";           // Suhu alat (°C)
                    $alatPercentField = "alat_percent_{$p}_{$interval}"; // % alat
                    
                    $alatCValue = $request->{$alatCField} ?? null;
                    $alatPercentValue = $request->{$alatPercentField} ?? null;
                    
                    // ✅ SESUAI MODEL: readAlat dan RHAlat
                    $readAlatValue = ($alatCValue !== null && $alatCValue !== '') 
                        ? (float) str_replace(',', '.', $alatCValue) 
                        : null;
                    $RHAlatValue = ($alatPercentValue !== null && $alatPercentValue !== '') 
                        ? (float) str_replace(',', '.', $alatPercentValue) 
                        : null;
                    
                    // Ambil data sensor (ulangan01-ulangan09)
                    $sensorData = [];
                    for ($col = 1; $col <= 9; $col++) {
                        $fieldName = "sensor_{$p}_{$interval}_{$col}";
                        $rawValue = $request->{$fieldName} ?? null;
                        $sensorData[$col] = ($rawValue !== null && $rawValue !== '') 
                            ? (float) str_replace(',', '.', $rawValue) 
                            : null;
                    }
                    
                    // % sensor (RHulangan)
                    $sensorPercentField = "sensor_percent_{$p}_{$interval}";
                    $sensorPercentValue = $request->{$sensorPercentField} ?? null;
                    $RHulanganValue = ($sensorPercentValue !== null && $sensorPercentValue !== '') 
                        ? (float) str_replace(',', '.', $sensorPercentValue) 
                        : null;
                    
                    // Cek apakah ada data
                    $hasData = $readAlatValue !== null || $RHAlatValue !== null || 
                              !empty(array_filter($sensorData, function($val) { return $val !== null; })) || 
                              $RHulanganValue !== null;
                    
                    if ($hasData) {
                        // ✅ SESUAI STRUKTUR MODEL LAMA
                        $detailData = [
                            'calibration_id' => $calibration->id,
                            
                            // Kolom sesuai model
                            'readAlat' => $readAlatValue,      // Suhu alat (°C)
                            'RHAlat' => $RHAlatValue,          // % alat
                            
                            // Sensor 1-9
                            'ulangan01' => $sensorData[1] ?? null,
                            'ulangan02' => $sensorData[2] ?? null,
                            'ulangan03' => $sensorData[3] ?? null,
                            'ulangan04' => $sensorData[4] ?? null,
                            'ulangan05' => $sensorData[5] ?? null,
                            'ulangan06' => $sensorData[6] ?? null,
                            'ulangan07' => $sensorData[7] ?? null,
                            'ulangan08' => $sensorData[8] ?? null,
                            'ulangan09' => $sensorData[9] ?? null,
                            
                            // % sensor
                            'RHulangan' => $RHulanganValue,
                        ];
                        
                        \Log::info("💾 Saving DetailChamber (OLD MODEL) for repetition {$p}, interval {$interval}", $detailData);
                        
                        try {
                            DetailChamber::create($detailData);
                            $detailCount++;
                            $totalDetailCount++;
                            \Log::info("✅ Successfully saved (OLD MODEL)");
                        } catch (\Exception $e) {
                            \Log::error("❌ Failed to save DetailChamber:", [
                                'error' => $e->getMessage(),
                                'data' => $detailData
                            ]);
                        }
                    }
                }
                
                \Log::info("✅ Saved {$detailCount} DetailChamber records for repetition {$p}");
            }
            
            \Log::info("✅ Saved {$totalDetailCount} DetailChamber records total");
            
            // ==================================================================
            // 5. SIMPAN ADD CHAMBER UNTUK SETIAP PENGULANGAN (jika diperlukan)
            // ==================================================================
            \Log::info('📊 Saving AddChamber data...');
            
            $intervalJson = json_encode($allIntervals);
            
            for ($p = 1; $p <= $repetition; $p++) {
                $tsettingValue = null;
                $fieldName = "suhu_setting_$p";
                if ($request->filled($fieldName)) {
                    $tsettingValue = (float) str_replace(',', '.', $request->$fieldName);
                }
                
                $tsettingJson = $tsettingValue !== null ? json_encode(['value' => $tsettingValue]) : null;
                
                AddChamber::create([
                    'calibration_id' => $calibration->id,
                    'repetition_number' => $p,
                    'Tsetting' => $tsettingJson,
                    'Interval' => $intervalJson,
                ]);
                
                \Log::info("✅ AddChamber saved for repetition {$p}");
            }
            
            // ==================================================================
            // 6. UPDATE CALIBRATION
            // ==================================================================
            $updateData = [];
            
            if ($request->filled('calibrated_by')) {
                $updateData['calibrated_by'] = $request->calibrated_by;
            }
            
            if ($request->filled('verified_by')) {
                $updateData['verified_by'] = $request->verified_by;
            }
            
            if ($request->filled('uncertainty')) {
                $updateData['uncertainty'] = $request->uncertainty;
                $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
            }
            
            if (!empty($updateData)) {
                $calibration->update($updateData);
                \Log::info('📝 Calibration updated');
            }
            
            // ==================================================================
            // 7. LOG HASIL AKHIR
            // ==================================================================
            $savedDetailCount = DetailChamber::where('calibration_id', $calibration->id)->count();
            $savedAddCount = AddChamber::where('calibration_id', $calibration->id)->count();
            
            \Log::info('📋 STORE SUMMARY:', [
                'calibration_id' => $calibration->id,
                'repetition_count' => $repetition,
                'detail_records' => $savedDetailCount,
                'add_records' => $savedAddCount,
                'expected_rows' => $repetition * count($allIntervals),
                'intervals' => $allIntervals,
                'standard' => $standardValue,
            ]);
            
            \Log::info('🎉 storeClimaticChamber COMPLETED');
            return true;
            
        } catch (\Exception $e) {
            \Log::error('💥 ERROR storeClimaticChamber:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            throw new \Exception("Gagal menyimpan data Climatic Chamber: " . $e->getMessage());
        }
    }

    private function updateClimaticChamber($request, $calibration)
{
    try {
        \Log::info('🚀 START updateClimaticChamber - SESUAI MODEL LAMA');
        
        $repetition = 1;
        for ($i = 1; $i <= 3; $i++) {
            if ($request->filled("suhu_setting_$i")) {
                $repetition = $i;
            }
        }
        
        \Log::info('📊 Jumlah pengulangan:', ['repetition' => $repetition]);
        
        $allIntervals = [1, 2, 3, 4, 5, 13, 20, 30];
        
        // ==================================================================
        // 1. UPDATE HEAD CHAMBER
        // ==================================================================
        $textValue = trim($request->alat_standar_text ?? '');
        $arrayValue = $request->input('alat_standar', []);
        
        if (!empty($textValue)) {
            $standardValue = $textValue;
        } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
            $standardValue = implode("\n", $arrayValue);
        } else {
            $standardValue = '';
        }
        
        if ($head = $calibration->headChamber) {
            $head->update(['standard' => $standardValue]);
            \Log::info('✅ HeadChamber updated');
        } else {
            $head = HeadChamber::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $standardValue,
                'calibrationMethod' => 'PAS-IK1102-29B',
            ]);
            \Log::info('➕ HeadChamber created baru');
        }
        
        // ==================================================================
        // 2. UPDATE DETAIL CHAMBER (DELETE & RECREATE) - SESUAI MODEL LAMA
        // ==================================================================
        DetailChamber::where('calibration_id', $calibration->id)->delete();
        
        $totalDetailCount = 0;
        
        for ($p = 1; $p <= $repetition; $p++) {
            $detailCount = 0;
            
            foreach ($allIntervals as $interval) {
                // Ambil data sesuai form
                $alatCField = "alat_{$p}_{$interval}";
                $alatPercentField = "alat_percent_{$p}_{$interval}";
                $sensorPercentField = "sensor_percent_{$p}_{$interval}";
                
                $alatCValue = $request->{$alatCField} ?? null;
                $alatPercentValue = $request->{$alatPercentField} ?? null;
                $sensorPercentValue = $request->{$sensorPercentField} ?? null;
                
                // Mapping ke model
                $readAlatValue = ($alatCValue !== null && $alatCValue !== '') 
                    ? (float) str_replace(',', '.', $alatCValue) 
                    : null;
                $RHAlatValue = ($alatPercentValue !== null && $alatPercentValue !== '') 
                    ? (float) str_replace(',', '.', $alatPercentValue) 
                    : null;
                $RHulanganValue = ($sensorPercentValue !== null && $sensorPercentValue !== '') 
                    ? (float) str_replace(',', '.', $sensorPercentValue) 
                    : null;
                
                // Sensor data
                $sensorData = [];
                for ($col = 1; $col <= 9; $col++) {
                    $fieldName = "sensor_{$p}_{$interval}_{$col}";
                    $rawValue = $request->{$fieldName} ?? null;
                    $sensorData[$col] = ($rawValue !== null && $rawValue !== '') 
                        ? (float) str_replace(',', '.', $rawValue) 
                        : null;
                }
                
                // Cek data
                $hasData = $readAlatValue !== null || $RHAlatValue !== null || 
                          !empty(array_filter($sensorData, function($val) { return $val !== null; })) || 
                          $RHulanganValue !== null;
                
                if ($hasData) {
                    // ✅ SESUAI MODEL LAMA
                    DetailChamber::create([
                        'calibration_id' => $calibration->id,
                        'readAlat' => $readAlatValue,
                        'RHAlat' => $RHAlatValue,
                        'ulangan01' => $sensorData[1] ?? null,
                        'ulangan02' => $sensorData[2] ?? null,
                        'ulangan03' => $sensorData[3] ?? null,
                        'ulangan04' => $sensorData[4] ?? null,
                        'ulangan05' => $sensorData[5] ?? null,
                        'ulangan06' => $sensorData[6] ?? null,
                        'ulangan07' => $sensorData[7] ?? null,
                        'ulangan08' => $sensorData[8] ?? null,
                        'ulangan09' => $sensorData[9] ?? null,
                        'RHulangan' => $RHulanganValue,
                    ]);
                    
                    $detailCount++;
                    $totalDetailCount++;
                }
            }
            
            \Log::info("✅ Saved {$detailCount} DetailChamber records for repetition {$p}");
        }
        
        \Log::info('✅ DetailChamber updated', ['total_records' => $totalDetailCount]);
        
        // ==================================================================
        // 3. UPDATE ADD CHAMBER
        // ==================================================================
        AddChamber::where('calibration_id', $calibration->id)->delete();
        
        $intervalJson = json_encode($allIntervals);
        
        for ($p = 1; $p <= $repetition; $p++) {
            $tsettingValue = null;
            $fieldName = "suhu_setting_$p";
            if ($request->filled($fieldName)) {
                $tsettingValue = (float) str_replace(',', '.', $request->$fieldName);
            }
            
            $tsettingJson = $tsettingValue !== null ? json_encode(['value' => $tsettingValue]) : null;
            
            AddChamber::create([
                'calibration_id' => $calibration->id,
                'repetition_number' => $p,
                'Tsetting' => $tsettingJson,
                'Interval' => $intervalJson,
            ]);
        }
        
        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibrated_by')) {
            $updateData['calibrated_by'] = $request->calibrated_by;
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }
        
        \Log::info('🎉 updateClimaticChamber COMPLETED');
        return true;
        
    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateClimaticChamber:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
        throw $e;
    }
}


private function storePressureGauge($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storePressureGauge - 20 BARIS (10 KIRI + 10 KANAN)');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - DARI INPUT FORM
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Pressure Gauge:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD PRESSURE GAUGE
        // ==================================================================
        $head = HeadPressureGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-17',
        ]);

        \Log::info('✅ HeadPressureGauge saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL PRESSURE GAUGE (20 BARIS: 10 KIRI + 10 KANAN)
        // ==================================================================
        \Log::info('📊 Saving Pressure Gauge detail measurements (20 rows)...');
        $detailCount = 0;
        
        // Proses 20 baris (10 kiri + 10 kanan)
        for ($i = 1; $i <= 20; $i++) {
            // Tentukan apakah ini baris kiri (1-10) atau kanan (11-20)
            if ($i <= 10) {
                // Baris kiri (1-10)
                $pembacaanAlat = $request->{"pembacaan_alat_kiri"} ?? [];
                $pembacaanAlatValue = $pembacaanAlat[$i-1] ?? null;
                $stdNaik = $request->{"naik_kiri_$i"} ?? null;
                $stdTurun = $request->{"turun_kiri_$i"} ?? null;
            } else {
                // Baris kanan (11-20)
                $pembacaanAlat = $request->{"pembacaan_alat_kanan"} ?? [];
                $index = $i - 11; // Index untuk array (0-9)
                $pembacaanAlatValue = $pembacaanAlat[$index] ?? null;
                $stdNaik = $request->{"naik_kanan_$i"} ?? null;
                $stdTurun = $request->{"turun_kanan_$i"} ?? null;
            }
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($pembacaanAlatValue) || !empty($stdNaik) || !empty($stdTurun);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($pembacaanAlatValue),
                    'STDNaik' => $this->formatNumericValue($stdNaik),
                    'STDTurun' => $this->formatNumericValue($stdTurun),
                ];
                
                DetailPressureGauge::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detail measurements for Pressure Gauge");

        // ==================================================================
        // 4. SIMPAN ADD PRESSURE GAUGE (DATA REPEATABILITY - HANYA 1 BARIS)
        // ==================================================================
        \Log::info('📊 Saving AddPressureGauge data (repeatability - single row)...');
        
        // Hanya simpan 1 baris untuk repeatability (sesuai model yang hanya sampai ulangan05)
        $repeatData = [
            'calibration_id' => $calibration->id,
            'repeatability' => $this->formatNumericValue($request->repeatability ?? null),
            'repeatabilitySTD' => $this->formatNumericValue($request->repeatability_unit ?? null),
            'ulangan01' => $this->formatNumericValue($request->row1_col1 ?? null),
            'ulangan02' => $this->formatNumericValue($request->row1_col2 ?? null),
            'ulangan03' => $this->formatNumericValue($request->row1_col3 ?? null),
            'ulangan04' => $this->formatNumericValue($request->row2_col1 ?? null),
            'ulangan05' => $this->formatNumericValue($request->row2_col2 ?? null),
        ];
        
        // Cek apakah ada data untuk disimpan
        $hasRepeatData = false;
        foreach ($repeatData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasRepeatData = true;
                break;
            }
        }
        
        if ($hasRepeatData) {
            $addRecord = AddPressureGauge::create($repeatData);
            \Log::info('✅ AddPressureGauge saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddPressureGauge data to save');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
            \Log::info('📝 Uncertainty data:', ['uncertainty' => $request->uncertainty]);
        }
        
        // Nama untuk TTD
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->nama_dikalibrasi]);
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->nama_diperiksa]);
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailPressureGauge::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddPressureGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Pressure Gauge - 20 rows):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storePressureGauge COMPLETED (20 rows total)');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storePressureGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailPressureGauge::where('calibration_id', $calibration->id)->delete();
                AddPressureGauge::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Pressure Gauge: " . $e->getMessage());
    }
}

/**
 * Update Pressure Gauge data - 20 BARIS (10 KIRI + 10 KANAN)
 */
private function updatePressureGauge($request, $calibration)
{
    try {
        \Log::info('🚀 START updatePressureGauge - 20 BARIS (10 KIRI + 10 KANAN)');
        
        // ==================================================================
        // 1. UPDATE HEAD PRESSURE GAUGE
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        if ($head = $calibration->headPressureGauge) {
            $head->update([
                'standard' => $alatStandarString,
            ]);
            \Log::info('✅ HeadPressureGauge updated:', ['standard' => $alatStandarString]);
        } else {
            // Jika head belum ada, buat baru
            $head = HeadPressureGauge::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-17',
            ]);
            \Log::info('➕ HeadPressureGauge created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL PRESSURE GAUGE (DELETE & RECREATE 20 BARIS)
        // ==================================================================
        // Hapus data detail lama
        DetailPressureGauge::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        // Proses 20 baris (10 kiri + 10 kanan)
        for ($i = 1; $i <= 20; $i++) {
            // Tentukan apakah ini baris kiri (1-10) atau kanan (11-20)
            if ($i <= 10) {
                // Baris kiri (1-10)
                $pembacaanAlat = $request->{"pembacaan_alat_kiri"} ?? [];
                $pembacaanAlatValue = $pembacaanAlat[$i-1] ?? null;
                $stdNaik = $request->{"naik_kiri_$i"} ?? null;
                $stdTurun = $request->{"turun_kiri_$i"} ?? null;
            } else {
                // Baris kanan (11-20)
                $pembacaanAlat = $request->{"pembacaan_alat_kanan"} ?? [];
                $index = $i - 11; // Index untuk array (0-9)
                $pembacaanAlatValue = $pembacaanAlat[$index] ?? null;
                $stdNaik = $request->{"naik_kanan_$i"} ?? null;
                $stdTurun = $request->{"turun_kanan_$i"} ?? null;
            }
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($pembacaanAlatValue) || !empty($stdNaik) || !empty($stdTurun);
            
            if ($hasData) {
                DetailPressureGauge::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($pembacaanAlatValue),
                    'STDNaik' => $this->formatNumericValue($stdNaik),
                    'STDTurun' => $this->formatNumericValue($stdTurun),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ DetailPressureGauge updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE ADD PRESSURE GAUGE (REPEATABILITY - HANYA 1 BARIS)
        // ==================================================================
        if ($addGauge = $calibration->addPressureGauge) {
            $addGauge->update([
                'repeatability' => $this->formatNumericValue($request->repeatability ?? $addGauge->repeatability),
                'repeatabilitySTD' => $this->formatNumericValue($request->repeatability_unit ?? $addGauge->repeatabilitySTD),
                'ulangan01' => $this->formatNumericValue($request->row1_col1 ?? $addGauge->ulangan01),
                'ulangan02' => $this->formatNumericValue($request->row1_col2 ?? $addGauge->ulangan02),
                'ulangan03' => $this->formatNumericValue($request->row1_col3 ?? $addGauge->ulangan03),
                'ulangan04' => $this->formatNumericValue($request->row2_col1 ?? $addGauge->ulangan04),
                'ulangan05' => $this->formatNumericValue($request->row2_col2 ?? $addGauge->ulangan05),
            ]);
            \Log::info('✅ AddPressureGauge updated');
        } else {
            // Buat baru jika belum ada
            $repeatData = [
                'calibration_id' => $calibration->id,
                'repeatability' => $this->formatNumericValue($request->repeatability ?? null),
                'repeatabilitySTD' => $this->formatNumericValue($request->repeatability_unit ?? null),
                'ulangan01' => $this->formatNumericValue($request->row1_col1 ?? null),
                'ulangan02' => $this->formatNumericValue($request->row1_col2 ?? null),
                'ulangan03' => $this->formatNumericValue($request->row1_col3 ?? null),
                'ulangan04' => $this->formatNumericValue($request->row2_col1 ?? null),
                'ulangan05' => $this->formatNumericValue($request->row2_col2 ?? null),
            ];
            
            $hasRepeatData = false;
            foreach ($repeatData as $key => $value) {
                if ($key !== 'calibration_id' && $value !== null) {
                    $hasRepeatData = true;
                    break;
                }
            }
            
            if ($hasRepeatData) {
                AddPressureGauge::create($repeatData);
                \Log::info('➕ AddPressureGauge created baru');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailPressureGauge::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddPressureGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Pressure Gauge - 20 rows):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'standard' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updatePressureGauge COMPLETED (20 rows total)');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updatePressureGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}



private function storeDifferentialPressureGauge($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeDifferentialPressureGauge - 20 BARIS (10 KIRI + 10 KANAN)');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - DARI INPUT FORM
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Differential Pressure Gauge:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD PRESSURE GAUGE
        // ==================================================================
        $head = HeadDifferentialPressureGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-17',
        ]);

        \Log::info('✅ HeadDifferentialPressureGauge saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL PRESSURE GAUGE (20 BARIS: 10 KIRI + 10 KANAN)
        // ==================================================================
        \Log::info('📊 Saving Pressure Gauge detail measurements (20 rows)...');
        $detailCount = 0;
        
        // Proses 20 baris (10 kiri + 10 kanan)
        for ($i = 1; $i <= 20; $i++) {
            // Tentukan apakah ini baris kiri (1-10) atau kanan (11-20)
            if ($i <= 10) {
                // Baris kiri (1-10)
                $pembacaanAlat = $request->{"pembacaan_alat_kiri"} ?? [];
                $pembacaanAlatValue = $pembacaanAlat[$i-1] ?? null;
                $stdNaik = $request->{"naik_kiri_$i"} ?? null;
                $stdTurun = $request->{"turun_kiri_$i"} ?? null;
            } else {
                // Baris kanan (11-20)
                $pembacaanAlat = $request->{"pembacaan_alat_kanan"} ?? [];
                $index = $i - 11; // Index untuk array (0-9)
                $pembacaanAlatValue = $pembacaanAlat[$index] ?? null;
                $stdNaik = $request->{"naik_kanan_$i"} ?? null;
                $stdTurun = $request->{"turun_kanan_$i"} ?? null;
            }
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($pembacaanAlatValue) || !empty($stdNaik) || !empty($stdTurun);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($pembacaanAlatValue),
                    'STDNaik' => $this->formatNumericValue($stdNaik),
                    'STDTurun' => $this->formatNumericValue($stdTurun),
                ];
                
                DetailDifferentialPressureGauge::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detail measurements for Pressure Gauge");

        // ==================================================================
        // 4. SIMPAN ADD PRESSURE GAUGE (DATA REPEATABILITY - HANYA 1 BARIS)
        // ==================================================================
        \Log::info('📊 Saving AddDifferentialPressureGauge data (repeatability - single row)...');
        
        // Hanya simpan 1 baris untuk repeatability (sesuai model yang hanya sampai ulangan05)
        $repeatData = [
            'calibration_id' => $calibration->id,
            'repeatability' => $this->formatNumericValue($request->repeatability ?? null),
            'repeatabilitySTD' => $this->formatNumericValue($request->repeatability_unit ?? null),
            'ulangan01' => $this->formatNumericValue($request->row1_col1 ?? null),
            'ulangan02' => $this->formatNumericValue($request->row1_col2 ?? null),
            'ulangan03' => $this->formatNumericValue($request->row1_col3 ?? null),
            'ulangan04' => $this->formatNumericValue($request->row2_col1 ?? null),
            'ulangan05' => $this->formatNumericValue($request->row2_col2 ?? null),
        ];
        
        // Cek apakah ada data untuk disimpan
        $hasRepeatData = false;
        foreach ($repeatData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasRepeatData = true;
                break;
            }
        }
        
        if ($hasRepeatData) {
            $addRecord = AddDifferentialPressureGauge::create($repeatData);
            \Log::info('✅ AddDifferentialPressureGauge saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddDifferentialPressureGauge data to save');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
            \Log::info('📝 Uncertainty data:', ['uncertainty' => $request->uncertainty]);
        }
        
        // Nama untuk TTD
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->nama_dikalibrasi]);
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->nama_diperiksa]);
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailDifferentialPressureGauge::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddDifferentialPressureGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Pressure Gauge - 20 rows):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storeDifferentialPressureGauge COMPLETED (20 rows total)');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeDifferentialPressureGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailDifferentialPressureGauge::where('calibration_id', $calibration->id)->delete();
                AddDifferentialPressureGauge::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Pressure Gauge: " . $e->getMessage());
    }
}

/**
 * Update Pressure Gauge data - 20 BARIS (10 KIRI + 10 KANAN)
 */
private function updateDifferentialPressureGauge($request, $calibration)
{
    try {
        \Log::info('🚀 START updateDifferentialPressureGauge - 20 BARIS (10 KIRI + 10 KANAN)');
        
        // ==================================================================
        // 1. UPDATE HEAD PRESSURE GAUGE
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        if ($head = $calibration->headDifferentialPressureGauge) {
            $head->update([
                'standard' => $alatStandarString,
            ]);
            \Log::info('✅ HeadDifferentialPressureGauge updated:', ['standard' => $alatStandarString]);
        } else {
            // Jika head belum ada, buat baru
            $head = HeadDifferentialPressureGauge::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-17',
            ]);
            \Log::info('➕ HeadDifferentialPressureGauge created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL PRESSURE GAUGE (DELETE & RECREATE 20 BARIS)
        // ==================================================================
        // Hapus data detail lama
        DetailDifferentialPressureGauge::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        // Proses 20 baris (10 kiri + 10 kanan)
        for ($i = 1; $i <= 20; $i++) {
            // Tentukan apakah ini baris kiri (1-10) atau kanan (11-20)
            if ($i <= 10) {
                // Baris kiri (1-10)
                $pembacaanAlat = $request->{"pembacaan_alat_kiri"} ?? [];
                $pembacaanAlatValue = $pembacaanAlat[$i-1] ?? null;
                $stdNaik = $request->{"naik_kiri_$i"} ?? null;
                $stdTurun = $request->{"turun_kiri_$i"} ?? null;
            } else {
                // Baris kanan (11-20)
                $pembacaanAlat = $request->{"pembacaan_alat_kanan"} ?? [];
                $index = $i - 11; // Index untuk array (0-9)
                $pembacaanAlatValue = $pembacaanAlat[$index] ?? null;
                $stdNaik = $request->{"naik_kanan_$i"} ?? null;
                $stdTurun = $request->{"turun_kanan_$i"} ?? null;
            }
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($pembacaanAlatValue) || !empty($stdNaik) || !empty($stdTurun);
            
            if ($hasData) {
                DetailDifferentialPressureGauge::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($pembacaanAlatValue),
                    'STDNaik' => $this->formatNumericValue($stdNaik),
                    'STDTurun' => $this->formatNumericValue($stdTurun),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ DetailDifferentialPressureGauge updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE ADD PRESSURE GAUGE (REPEATABILITY - HANYA 1 BARIS)
        // ==================================================================
        if ($addGauge = $calibration->addDifferentialPressureGauge) {
            $addGauge->update([
                'repeatability' => $this->formatNumericValue($request->repeatability ?? $addGauge->repeatability),
                'repeatabilitySTD' => $this->formatNumericValue($request->repeatability_unit ?? $addGauge->repeatabilitySTD),
                'ulangan01' => $this->formatNumericValue($request->row1_col1 ?? $addGauge->ulangan01),
                'ulangan02' => $this->formatNumericValue($request->row1_col2 ?? $addGauge->ulangan02),
                'ulangan03' => $this->formatNumericValue($request->row1_col3 ?? $addGauge->ulangan03),
                'ulangan04' => $this->formatNumericValue($request->row2_col1 ?? $addGauge->ulangan04),
                'ulangan05' => $this->formatNumericValue($request->row2_col2 ?? $addGauge->ulangan05),
            ]);
            \Log::info('✅ AddDifferentialPressureGauge updated');
        } else {
            // Buat baru jika belum ada
            $repeatData = [
                'calibration_id' => $calibration->id,
                'repeatability' => $this->formatNumericValue($request->repeatability ?? null),
                'repeatabilitySTD' => $this->formatNumericValue($request->repeatability_unit ?? null),
                'ulangan01' => $this->formatNumericValue($request->row1_col1 ?? null),
                'ulangan02' => $this->formatNumericValue($request->row1_col2 ?? null),
                'ulangan03' => $this->formatNumericValue($request->row1_col3 ?? null),
                'ulangan04' => $this->formatNumericValue($request->row2_col1 ?? null),
                'ulangan05' => $this->formatNumericValue($request->row2_col2 ?? null),
            ];
            
            $hasRepeatData = false;
            foreach ($repeatData as $key => $value) {
                if ($key !== 'calibration_id' && $value !== null) {
                    $hasRepeatData = true;
                    break;
                }
            }
            
            if ($hasRepeatData) {
                AddDifferentialPressureGauge::create($repeatData);
                \Log::info('➕ AddDifferentialPressureGauge created baru');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailDifferentialPressureGauge::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddDifferentialPressureGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Pressure Gauge - 20 rows):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'standard' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updateDifferentialPressureGauge COMPLETED (20 rows total)');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateDifferentialPressureGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}

private function storeVolumetrik($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeVolumetrik - SESUAI MODELS');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD VOLUMETRIK
        // ==================================================================
        $head = HeadVolumetrik::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-38 (Volumetrik Glassware)',
        ]);

        \Log::info('✅ HeadVolumetrik saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL VOLUMETRIK (5 BARIS: 1 BARIS PER NOMINAL)
        // ==================================================================
        \Log::info('📊 Saving DetailVolumetrik data (5 rows)...');
        $detailCount = 0;
        
        for ($nominal = 1; $nominal <= 5; $nominal++) {
            // Ambil nilai nominal dari form
            $nominalValue = $request->{"nominal_{$nominal}"} ?? null;
            
            // Jika ada nominal, simpan semua data untuk nominal tersebut
            if (!empty($nominalValue)) {
                // Kumpulkan data untuk 3 pengulangan
                $masssaKosong01 = $this->formatNumericValue($request->{"massa_kosong_{$nominal}_1"} ?? null);
                $masssaKosong02 = $this->formatNumericValue($request->{"massa_kosong_{$nominal}_2"} ?? null);
                $masssaKosong03 = $this->formatNumericValue($request->{"massa_kosong_{$nominal}_3"} ?? null);
                
                $massaIsi01 = $this->formatNumericValue($request->{"massa_isi_{$nominal}_1"} ?? null);
                $massaIsi02 = $this->formatNumericValue($request->{"massa_isi_{$nominal}_2"} ?? null);
                $massaIsi03 = $this->formatNumericValue($request->{"massa_isi_{$nominal}_3"} ?? null);
                
                $T_airSuling01 = $this->formatNumericValue($request->{"suhu_{$nominal}_1"} ?? null);
                $T_airSuling02 = $this->formatNumericValue($request->{"suhu_{$nominal}_2"} ?? null);
                $T_airSuling03 = $this->formatNumericValue($request->{"suhu_{$nominal}_3"} ?? null);
                
                $P_Udara01 = $this->formatNumericValue($request->{"tekanan_{$nominal}_1"} ?? null);
                $P_Udara02 = $this->formatNumericValue($request->{"tekanan_{$nominal}_2"} ?? null);
                $P_Udara03 = $this->formatNumericValue($request->{"tekanan_{$nominal}_3"} ?? null);
                
                // Cek apakah ada data minimal 1 nilai
                $hasData = !empty($masssaKosong01) || !empty($masssaKosong02) || !empty($masssaKosong03) ||
                          !empty($massaIsi01) || !empty($massaIsi02) || !empty($massaIsi03) ||
                          !empty($T_airSuling01) || !empty($T_airSuling02) || !empty($T_airSuling03) ||
                          !empty($P_Udara01) || !empty($P_Udara02) || !empty($P_Udara03);
                
                if ($hasData) {
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'head_volumetrik_id' => $head->id, // Tambahkan ini untuk relasi
                        'titikUkur' => $this->formatNumericValue($nominalValue),
                        'masssaKosong01' => $masssaKosong01,
                        'masssaKosong02' => $masssaKosong02,
                        'masssaKosong03' => $masssaKosong03,
                        'massaIsi01' => $massaIsi01,
                        'massaIsi02' => $massaIsi02,
                        'massaIsi03' => $massaIsi03,
                        'T_airSuling01' => $T_airSuling01,
                        'T_airSuling02' => $T_airSuling02,
                        'T_airSuling03' => $T_airSuling03,
                        'P_Udara01' => $P_Udara01,
                        'P_Udara02' => $P_Udara02,
                        'P_Udara03' => $P_Udara03,
                    ];
                    
                    DetailVolumetrik::create($detailData);
                    $detailCount++;
                    \Log::info("💾 Saved detail for nominal: {$nominalValue}");
                }
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailVolumetrik records");

    // ==================================================================
    // 4. SIMPAN ADD VOLUMETRIK (REPEATABILITY - 10 BARIS)
    // ==================================================================
    \Log::info('📊 Saving AddVolumetrik data (repeatability - 10 repetitions)...');

    // Ambil nilai titik ukur (nominal) dari input repeatability_nominal (hanya satu)
    $repeatabilityNominal = $this->formatNumericValue($request->repeatability_nominal ?? null);

    $addCount = 0;

    // Loop untuk 10 pengulangan
    for ($i = 1; $i <= 10; $i++) {
        // Ambil data dari masing-masing baris pengulangan
        $massaKosong = $this->formatNumericValue($request->{"repeat_massa_kosong_{$i}"} ?? null);
        $massaIsi    = $this->formatNumericValue($request->{"repeat_massa_isi_{$i}"} ?? null);
        $suhu        = $this->formatNumericValue($request->{"repeat_suhu_{$i}"} ?? null);
        $tekanan     = $this->formatNumericValue($request->{"repeat_tekanan_{$i}"} ?? null);

        // Cek apakah ada setidaknya satu field yang terisi di baris ini
        if ($massaKosong !== null || $massaIsi !== null || $suhu !== null || $tekanan !== null) {
            
            $addData = [
                'calibration_id' => $calibration->id,
                'titikUkur'      => $repeatabilityNominal, // Sama untuk semua 10 baris
                'massaKosong'    => $massaKosong,
                'massaIsi'       => $massaIsi,
                'T_airSuling'    => $suhu,
                'P_Udara'        => $tekanan,
            ];

            AddVolumetrik::create($addData);
            $addCount++;
            
            \Log::info("💾 Saved AddVolumetrik repetition {$i}", $addData);
        }
    }

    if ($addCount > 0) {
        \Log::info("✅ Successfully saved {$addCount} AddVolumetrik records (repeatability)");
    } else {
        \Log::info('⚠️ No AddVolumetrik data was filled or saved');
    }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TTD
        // ==================================================================
        $updateData = [];
        
        // Nama untuk TTD Dikalibrasi
        if ($request->filled('calibrated_by ')) {
            $updateData['calibrated_by'] = $request->calibrated_by ;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->calibrated_by ]);
        }
        
        // Nama untuk TTD Diperiksa
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->verified_by]);
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with TTD data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailVolumetrik::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddVolumetrik::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Volumetrik):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
        ]);

        \Log::info('🎉 storeVolumetrik COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeVolumetrik:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback
        if (isset($head) && $head->id) {
            try {
                DetailVolumetrik::where('calibration_id', $calibration->id)->delete();
                AddVolumetrik::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Volumetrik: " . $e->getMessage());
    }
}

private function updateVolumetrik($request, $calibration)
{
    try {
        \Log::info('🚀 START updateVolumetrik - SESUAI MODELS');
        
        // ==================================================================
        // 1. UPDATE HEAD VOLUMETRIK
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        if ($head = $calibration->headVolumetrik) {
            $head->update(['standard' => $alatStandarString]);
            $headId = $head->id;
            \Log::info('✅ HeadVolumetrik updated');
        } else {
            $head = HeadVolumetrik::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-38 (Volumetrik Glassware)',
            ]);
            $headId = $head->id;
            \Log::info('➕ HeadVolumetrik created baru');
        }

        // ==================================================================
        // 2. UPDATE DETAIL VOLUMETRIK (DELETE & RECREATE)
        // ==================================================================
        DetailVolumetrik::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        for ($nominal = 1; $nominal <= 5; $nominal++) {
            $nominalValue = $request->{"nominal_{$nominal}"} ?? null;
            
            if (!empty($nominalValue)) {
                $masssaKosong01 = $this->formatNumericValue($request->{"massa_kosong_{$nominal}_1"} ?? null);
                $masssaKosong02 = $this->formatNumericValue($request->{"massa_kosong_{$nominal}_2"} ?? null);
                $masssaKosong03 = $this->formatNumericValue($request->{"massa_kosong_{$nominal}_3"} ?? null);
                
                $massaIsi01 = $this->formatNumericValue($request->{"massa_isi_{$nominal}_1"} ?? null);
                $massaIsi02 = $this->formatNumericValue($request->{"massa_isi_{$nominal}_2"} ?? null);
                $massaIsi03 = $this->formatNumericValue($request->{"massa_isi_{$nominal}_3"} ?? null);
                
                $T_airSuling01 = $this->formatNumericValue($request->{"suhu_{$nominal}_1"} ?? null);
                $T_airSuling02 = $this->formatNumericValue($request->{"suhu_{$nominal}_2"} ?? null);
                $T_airSuling03 = $this->formatNumericValue($request->{"suhu_{$nominal}_3"} ?? null);
                
                $P_Udara01 = $this->formatNumericValue($request->{"tekanan_{$nominal}_1"} ?? null);
                $P_Udara02 = $this->formatNumericValue($request->{"tekanan_{$nominal}_2"} ?? null);
                $P_Udara03 = $this->formatNumericValue($request->{"tekanan_{$nominal}_3"} ?? null);
                
                // Cek apakah ada data
                $hasData = !empty($masssaKosong01) || !empty($masssaKosong02) || !empty($masssaKosong03) ||
                          !empty($massaIsi01) || !empty($massaIsi02) || !empty($massaIsi03) ||
                          !empty($T_airSuling01) || !empty($T_airSuling02) || !empty($T_airSuling03) ||
                          !empty($P_Udara01) || !empty($P_Udara02) || !empty($P_Udara03);
                
                if ($hasData) {
                    DetailVolumetrik::create([
                        'calibration_id' => $calibration->id,
                        'head_volumetrik_id' => $headId,
                        'titikUkur' => $this->formatNumericValue($nominalValue),
                        'masssaKosong01' => $masssaKosong01,
                        'masssaKosong02' => $masssaKosong02,
                        'masssaKosong03' => $masssaKosong03,
                        'massaIsi01' => $massaIsi01,
                        'massaIsi02' => $massaIsi02,
                        'massaIsi03' => $massaIsi03,
                        'T_airSuling01' => $T_airSuling01,
                        'T_airSuling02' => $T_airSuling02,
                        'T_airSuling03' => $T_airSuling03,
                        'P_Udara01' => $P_Udara01,
                        'P_Udara02' => $P_Udara02,
                        'P_Udara03' => $P_Udara03,
                    ]);
                    $detailCount++;
                }
            }
        }
        
        \Log::info('✅ DetailVolumetrik updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE ADD VOLUMETRIK (REPEATABILITY)
        // ==================================================================
        // Cari nominal untuk repeatability
        $repeatabilityNominal = null;
        for ($nominal = 1; $nominal <= 5; $nominal++) {
            if (!empty($request->{"nominal_{$nominal}"})) {
                $repeatabilityNominal = $this->formatNumericValue($request->{"nominal_{$nominal}"});
                break;
            }
        }
        
        if ($addVolumetrik = $calibration->addVolumetrik) {
            $addVolumetrik->update([
                'titikUkur' => $repeatabilityNominal,
                'massaKosong' => $this->formatNumericValue($request->repeat_massa_kosong_1 ?? null),
                'massaIsi' => $this->formatNumericValue($request->repeat_massa_isi_1 ?? null),
                'T_airSuling' => $this->formatNumericValue($request->repeat_suhu_1 ?? null),
                'P_Udara' => $this->formatNumericValue($request->repeat_tekanan_1 ?? null),
            ]);
            \Log::info('✅ AddVolumetrik updated');
        } else {
            // Cek apakah ada data untuk disimpan
            $hasData = $repeatabilityNominal !== null || 
                      $request->filled('repeat_massa_kosong_1') ||
                      $request->filled('repeat_massa_isi_1') ||
                      $request->filled('repeat_suhu_1') ||
                      $request->filled('repeat_tekanan_1');
            
            if ($hasData) {
                AddVolumetrik::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $repeatabilityNominal,
                    'massaKosong' => $this->formatNumericValue($request->repeat_massa_kosong_1 ?? null),
                    'massaIsi' => $this->formatNumericValue($request->repeat_massa_isi_1 ?? null),
                    'T_airSuling' => $this->formatNumericValue($request->repeat_suhu_1 ?? null),
                    'P_Udara' => $this->formatNumericValue($request->repeat_tekanan_1 ?? null),
                ]);
                \Log::info('➕ AddVolumetrik created baru');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibrated_by ')) {
            $updateData['calibrated_by'] = $request->calibrated_by ;
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailVolumetrik::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddVolumetrik::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Volumetrik):', [
            'calibration_id' => $calibration->id,
            'head_id' => $headId,
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'standard' => $alatStandarString,
        ]);

        \Log::info('🎉 updateVolumetrik COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateVolumetrik:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);
        throw $e;
    }
}

private function storeThermohygrometer($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeThermohygrometer');
        
        // ==================================================================
        // 1. TENTUKAN TYPE (IN/OUT atau SINGLE)
        // ==================================================================
        $type = $request->type ?? 'single';
        
        // Validasi type
        if (!in_array($type, ['in_out', 'single'])) {
            $type = 'single';
            \Log::warning('⚠️ Type invalid, set to default: single');
        }
        
        \Log::info('📊 Thermohygrometer type:', ['type' => $type]);
        
        // ==================================================================
        // 2. SIMPAN TYPE KE CALIBRATION TABLE
        // ==================================================================
        $calibration->update([
            'type' => $type,
        ]);
        
        \Log::info('✅ Thermohygrometer type saved to calibration');
        
        // ==================================================================
        // 3. TENTUKAN STANDARD DAN METHOD BERDASARKAN TYPE
        // ==================================================================
        if ($type === 'in_out') {
            // UNTUK TYPE IN/OUT: STANDARD FIXED (DEFAULT)
            $alatStandarString = 'Temperature & Humidity Transmitter, Rotronic, 71946262; 20345594';
            $calibrationMethod = 'PAS-IK1102-50';
            \Log::info('🔧 Alat standar selected (IN/OUT fixed):', ['alat_standar' => $alatStandarString]);
        } else {
            // UNTUK TYPE SINGLE: AMBIL DARI INPUT USER
            $alatStandar = $request->alat_standar ?? [];
            $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
            
            // Jika kosong, gunakan default (fallback)
            if (empty($alatStandarString)) {
                $alatStandarString = 'Temperature & Humidity Transmitter, Rotronic, 71946262; 20345594';
                \Log::warning('⚠️ No alat_standar provided for SINGLE type, using default');
            }
            
            $calibrationMethod = $request->calibration_method ?? 'PAS-IK1102-50';
            
            \Log::info('📌 Using custom standard for SINGLE type', [
                'alat_standar_raw' => $alatStandar,
                'alat_standar_string' => $alatStandarString
            ]);
        }
        
        \Log::info('📊 Standard and method determined:', [
            'type' => $type,
            'standard' => $alatStandarString,
            'method' => $calibrationMethod
        ]);
        
        // ==================================================================
        // 4. SIMPAN KE HEAD THERMOHYGROMETER (standard dan method)
        // ==================================================================
        $headData = [
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => $calibrationMethod,
        ];
        
        // Cek apakah head sudah ada (untuk update scenario)
        $headThermohygrometer = \App\Models\HeadThermohygrometer::where('calibration_id', $calibration->id)->first();
        
        if ($headThermohygrometer) {
            // Update head yang sudah ada
            $headThermohygrometer->update($headData);
            \Log::info('✅ Updated existing HeadThermohygrometer');
        } else {
            // Buat head baru
            \App\Models\HeadThermohygrometer::create($headData);
            \Log::info('✅ Created new HeadThermohygrometer');
        }
        
        // ==================================================================
        // 5. HAPUS DATA DETAIL LAMA JIKA ADA (untuk update)
        // ==================================================================
        $existingDetails = \App\Models\DetailThermohygrometer::where('calibration_id', $calibration->id)->count();
        if ($existingDetails > 0) {
            \App\Models\DetailThermohygrometer::where('calibration_id', $calibration->id)->delete();
            \Log::info("🔄 Deleted {$existingDetails} old detail records");
        }
        
        // ==================================================================
        // 6. SIMPAN DETAIL BERDASARKAN TYPE
        // ==================================================================
        \Log::info('📊 Saving Thermohygrometer detail measurements...');
        
        $detailCount = 0;
        
        if ($type === 'in_out') {
            // PROSES 7 BARIS UNTUK TIPE IN/OUT
            \Log::info('Processing IN/OUT data (7 rows)...');
            
            for ($i = 0; $i < 7; $i++) {
                $tempData = $request->input("temp.{$i}", []);
                $humidityData = $request->input("humidity.{$i}", []);
                
                // Cek apakah ada data untuk baris ini
                $hasTempData = !empty(array_filter($tempData, function($value) {
                    return $value !== null && $value !== '';
                }));
                
                $hasHumidityData = !empty(array_filter($humidityData, function($value) {
                    return $value !== null && $value !== '';
                }));
                
                if ($hasTempData || $hasHumidityData) {
                    try {
                        \App\Models\DetailThermohygrometer::create([
                            'calibration_id' => $calibration->id,
                            
                            // Data Temperatur
                            'titikUkur_T' => $this->formatNumericValue($tempData['set_point'] ?? null),
                            'T_STD1' => $this->formatNumericValue($tempData['std_x1'] ?? null),
                            'T_STD2' => $this->formatNumericValue($tempData['std_x2'] ?? null),
                            'T_STD3' => $this->formatNumericValue($tempData['std_x3'] ?? null),
                            'T_IN1' => $this->formatNumericValue($tempData['in_x1'] ?? null),
                            'T_IN2' => $this->formatNumericValue($tempData['in_x2'] ?? null),
                            'T_IN3' => $this->formatNumericValue($tempData['in_x3'] ?? null),
                            'T_OUT1' => $this->formatNumericValue($tempData['out_x1'] ?? null),
                            'T_OUT2' => $this->formatNumericValue($tempData['out_x2'] ?? null),
                            'T_OUT3' => $this->formatNumericValue($tempData['out_x3'] ?? null),
                            
                            // Data Kelembaban
                            'titikUkur_RH' => $this->formatNumericValue($humidityData['set_point'] ?? null),
                            'RH_STD1' => $this->formatNumericValue($humidityData['std_x1'] ?? null),
                            'RH_STD2' => $this->formatNumericValue($humidityData['std_x2'] ?? null),
                            'RH_STD3' => $this->formatNumericValue($humidityData['std_x3'] ?? null),
                            'RH_ALAT1' => $this->formatNumericValue($humidityData['alat_x1'] ?? null),
                            'RH_ALAT2' => $this->formatNumericValue($humidityData['alat_x2'] ?? null),
                            'RH_ALAT3' => $this->formatNumericValue($humidityData['alat_x3'] ?? null),
                        ]);
                        
                        $detailCount++;
                        \Log::debug("✅ Saved IN/OUT row {$i}");
                        
                    } catch (\Exception $e) {
                        \Log::error("❌ Failed to save IN/OUT row {$i}: " . $e->getMessage());
                    }
                } else {
                    \Log::debug("⏭️ Skipping IN/OUT row {$i} - no data");
                }
            }
            
        } else {
            // PROSES 10 BARIS UNTUK TIPE SINGLE
            \Log::info('Processing SINGLE data (10 rows)...');
            
            for ($i = 1; $i <= 10; $i++) {
                // Cek apakah ada data untuk baris ini
                $hasTempData = $request->filled("t_set{$i}") || 
                              $request->filled("t_std{$i}_1") ||
                              $request->filled("t_inst{$i}_1");
                
                $hasHumidityData = $request->filled("h_set{$i}") || 
                                  $request->filled("h_std{$i}_1") ||
                                  $request->filled("h_inst{$i}_1");
                
                if ($hasTempData || $hasHumidityData) {
                    try {
                        \App\Models\DetailThermohygrometer::create([
                            'calibration_id' => $calibration->id,
                            
                            // Data Temperatur
                            'titikUkur_T' => $this->formatNumericValue($request->input("t_set{$i}")),
                            'T_STD1' => $this->formatNumericValue($request->input("t_std{$i}_1")),
                            'T_STD2' => $this->formatNumericValue($request->input("t_std{$i}_2")),
                            'T_STD3' => $this->formatNumericValue($request->input("t_std{$i}_3")),
                            'T_IN1' => null,  // DIKOSONGKAN untuk type single
                            'T_IN2' => null,  // DIKOSONGKAN untuk type single
                            'T_IN3' => null,  // DIKOSONGKAN untuk type single
                            'T_OUT1' => null, // DIKOSONGKAN untuk type single
                            'T_OUT2' => null, // DIKOSONGKAN untuk type single
                            'T_OUT3' => null, // DIKOSONGKAN untuk type single
                            
                            // Data Kelembaban
                            'titikUkur_RH' => $this->formatNumericValue($request->input("h_set{$i}")),
                            'RH_STD1' => $this->formatNumericValue($request->input("h_std{$i}_1")),
                            'RH_STD2' => $this->formatNumericValue($request->input("h_std{$i}_2")),
                            'RH_STD3' => $this->formatNumericValue($request->input("h_std{$i}_3")),
                            'RH_ALAT1' => $this->formatNumericValue($request->input("h_inst{$i}_1")),
                            'RH_ALAT2' => $this->formatNumericValue($request->input("h_inst{$i}_2")),
                            'RH_ALAT3' => $this->formatNumericValue($request->input("h_inst{$i}_3")),
                        ]);
                        
                        $detailCount++;
                        \Log::debug("✅ Saved SINGLE row {$i}");
                        
                    } catch (\Exception $e) {
                        \Log::error("❌ Failed to save SINGLE row {$i}: " . $e->getMessage());
                    }
                } else {
                    \Log::debug("⏭️ Skipping SINGLE row {$i} - no data");
                }
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detail records");
        
        // ==================================================================
        // 7. SIMPAN DATA TTD DAN NAMA (DI CALIBRATION TABLE)
        // ==================================================================
        $additionalData = [];
        
        if ($request->filled('calibrated_by')) {
            $additionalData['calibrated_by'] = $request->calibrated_by;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->calibrated_by]);
        }
        
        if ($request->filled('verified_by')) {
            $additionalData['verified_by'] = $request->verified_by;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->verified_by]);
        }
        
        if ($request->filled('uncertainty')) {
            $additionalData['uncertainty'] = $request->uncertainty;
            $additionalData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Simpan juga alat standar ke calibration jika diperlukan
        if (!empty($alatStandarString)) {
            $additionalData['alat_standar'] = $alatStandarString;
        }
        
        if ($request->filled('calibration_method')) {
            $additionalData['calibration_method'] = $request->calibration_method;
        }
        
        if (!empty($additionalData)) {
            $calibration->update($additionalData);
            \Log::info('✅ Additional data saved to calibration');
        }
        
        // ==================================================================
        // 8. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = \App\Models\DetailThermohygrometer::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Thermohygrometer):', [
            'calibration_id' => $calibration->id,
            'type' => $type,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'calibration_method' => $calibrationMethod,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
            'uncertainty' => $calibration->uncertainty ?? null,
        ]);
        
        \Log::info('🎉 storeThermohygrometer COMPLETED');
        return true;
        
    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeThermohygrometer:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A'
        ]);
        
        throw new \Exception("Gagal menyimpan data Thermohygrometer: " . $e->getMessage());
    }
}

private function storeViscometer($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeViscometer');

        // ==================================================================
        // 1. PROSES ALAT STANDAR (8 CHECKBOX)
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Viscometer:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD VISCOMETER
        // ==================================================================
        $head = HeadViscometer::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-43',
        ]);

        \Log::info('✅ HeadViscometer saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL MEASUREMENTS (15 BARIS)
        // ==================================================================
        \Log::info('📊 Saving Viscometer detail measurements (15 rows)...');
        $detailCount = 0;
        
        for ($row = 0; $row < 15; $row++) {
            // Ambil data dari request sesuai dengan struktur form
            $nilaiStandard = $request->{"nilai_standard.{$row}"} ?? null;
            $spindle = $request->{"spindle.{$row}"} ?? null;
            $rpm = $request->{"rpm.{$row}"} ?? null;
            $pembacaan1 = $request->{"pembacaan_1.{$row}"} ?? null;
            $pembacaan2 = $request->{"pembacaan_2.{$row}"} ?? null;
            $pembacaan3 = $request->{"pembacaan_3.{$row}"} ?? null;
            $pembacaan4 = $request->{"pembacaan_4.{$row}"} ?? null;
            $pembacaan5 = $request->{"pembacaan_5.{$row}"} ?? null;
            $resolusi = $request->{"resolusi.{$row}"} ?? null;
            $suhuAwal = $request->{"suhu_awal.{$row}"} ?? null;
            $suhuAkhir = $request->{"suhu_akhir.{$row}"} ?? null;
            
            // Cek apakah ada data untuk baris ini (minimal satu kolom terisi)
            $hasData = !empty($nilaiStandard) || !empty($spindle) || !empty($rpm) || 
                      !empty($pembacaan1) || !empty($pembacaan2) || !empty($pembacaan3) ||
                      !empty($pembacaan4) || !empty($pembacaan5) || !empty($resolusi) ||
                      !empty($suhuAwal) || !empty($suhuAkhir);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nilaiStandard' => $this->formatNumericValue($nilaiStandard),
                    'spindle' => $this->formatNumericValue($spindle),
                    'rpm' => $this->formatNumericValue($rpm),
                    'pembacaan1' => $this->formatNumericValue($pembacaan1),
                    'pembacaan2' => $this->formatNumericValue($pembacaan2),
                    'pembacaan3' => $this->formatNumericValue($pembacaan3),
                    'pembacaan4' => $this->formatNumericValue($pembacaan4),
                    'pembacaan5' => $this->formatNumericValue($pembacaan5),
                    'resolusi' => $this->formatNumericValue($resolusi),
                    'suhuAwal' => $this->formatNumericValue($suhuAwal),
                    'suhuAkhir' => $this->formatNumericValue($suhuAkhir),
                ];
                
                DetailViscometer::create($detailData);
                $detailCount++;
                
                \Log::debug("📝 Saved Viscometer row {$row}", [
                    'nilaiStandard' => $nilaiStandard,
                    'spindle' => $spindle,
                    'rpm' => $rpm
                ]);
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detail measurements for Viscometer");

        // ==================================================================
        // 4. UPDATE CALIBRATION DENGAN DATA TAMBAHAN (TTD)
        // ==================================================================
        $updateData = [];
        
        // Nama untuk TTD Dikalibrasi
        if ($request->filled('dikalibrasi_nama')) {
            $updateData['calibrated_by'] = $request->dikalibrasi_nama;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->dikalibrasi_nama]);
        }
        
        // Nama untuk TTD Diperiksa
        if ($request->filled('diperiksa_nama')) {
            $updateData['verified_by'] = $request->diperiksa_nama;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->diperiksa_nama]);
        }
        
        // TTD Dikalibrasi
        if ($request->filled('dikalibrasi_ttd')) {
            \Log::info('✍️ TTD dikalibrasi:', ['ttd' => $request->dikalibrasi_ttd]);
            // Simpan ke head atau calibration jika ada field untuk TTD
            if ($head) {
                $head->update(['ttd_kalibrator' => $request->dikalibrasi_ttd]);
            }
        }
        
        // TTD Diperiksa
        if ($request->filled('diperiksa_ttd')) {
            \Log::info('✍️ TTD diperiksa:', ['ttd' => $request->diperiksa_ttd]);
            // Simpan ke head atau calibration jika ada field untuk TTD
            if ($head) {
                $head->update(['ttd_pemeriksa' => $request->diperiksa_ttd]);
            }
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailViscometer::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Viscometer):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storeViscometer COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeViscometer:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailViscometer::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Viscometer: " . $e->getMessage());
    }
}

/**
 * Update Viscometer data
 */
private function updateViscometer($request, $calibration)
{
    try {
        \Log::info('🚀 START updateViscometer');
        
        // ==================================================================
        // 1. UPDATE HEAD VISCOMETER
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        if ($head = $calibration->headViscometer) {
            $head->update([
                'standard' => $alatStandarString,
            ]);
            \Log::info('✅ HeadViscometer updated:', ['standard' => $alatStandarString]);
        } else {
            // Jika head belum ada, buat baru
            $head = HeadViscometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-43',
            ]);
            \Log::info('➕ HeadViscometer created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL VISCOMETER (DELETE & RECREATE 15 BARIS)
        // ==================================================================
        // Hapus data detail lama
        DetailViscometer::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        // Proses 15 baris
        for ($row = 0; $row < 15; $row++) {
            // Ambil data dari request
            $nilaiStandard = $request->{"nilai_standard.{$row}"} ?? null;
            $spindle = $request->{"spindle.{$row}"} ?? null;
            $rpm = $request->{"rpm.{$row}"} ?? null;
            $pembacaan1 = $request->{"pembacaan_1.{$row}"} ?? null;
            $pembacaan2 = $request->{"pembacaan_2.{$row}"} ?? null;
            $pembacaan3 = $request->{"pembacaan_3.{$row}"} ?? null;
            $pembacaan4 = $request->{"pembacaan_4.{$row}"} ?? null;
            $pembacaan5 = $request->{"pembacaan_5.{$row}"} ?? null;
            $resolusi = $request->{"resolusi.{$row}"} ?? null;
            $suhuAwal = $request->{"suhu_awal.{$row}"} ?? null;
            $suhuAkhir = $request->{"suhu_akhir.{$row}"} ?? null;
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($nilaiStandard) || !empty($spindle) || !empty($rpm) || 
                      !empty($pembacaan1) || !empty($pembacaan2) || !empty($pembacaan3) ||
                      !empty($pembacaan4) || !empty($pembacaan5) || !empty($resolusi) ||
                      !empty($suhuAwal) || !empty($suhuAkhir);
            
            if ($hasData) {
                DetailViscometer::create([
                    'calibration_id' => $calibration->id,
                    'nilaiStandard' => $this->formatNumericValue($nilaiStandard),
                    'spindle' => $this->formatNumericValue($spindle),
                    'rpm' => $this->formatNumericValue($rpm),
                    'pembacaan1' => $this->formatNumericValue($pembacaan1),
                    'pembacaan2' => $this->formatNumericValue($pembacaan2),
                    'pembacaan3' => $this->formatNumericValue($pembacaan3),
                    'pembacaan4' => $this->formatNumericValue($pembacaan4),
                    'pembacaan5' => $this->formatNumericValue($pembacaan5),
                    'resolusi' => $this->formatNumericValue($resolusi),
                    'suhuAwal' => $this->formatNumericValue($suhuAwal),
                    'suhuAkhir' => $this->formatNumericValue($suhuAkhir),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ DetailViscometer updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE TTD DI HEAD VISCOMETER
        // ==================================================================
        if ($head) {
            $ttdUpdate = [];
            
            if ($request->filled('dikalibrasi_ttd')) {
                $ttdUpdate['ttd_kalibrator'] = $request->dikalibrasi_ttd;
            }
            
            if ($request->filled('diperiksa_ttd')) {
                $ttdUpdate['ttd_pemeriksa'] = $request->diperiksa_ttd;
            }
            
            if (!empty($ttdUpdate)) {
                $head->update($ttdUpdate);
                \Log::info('✅ TTD updated in HeadViscometer');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('dikalibrasi_nama')) {
            $updateData['calibrated_by'] = $request->dikalibrasi_nama;
        }
        
        if ($request->filled('diperiksa_nama')) {
            $updateData['verified_by'] = $request->diperiksa_nama;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailViscometer::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Viscometer):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'standard' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updateViscometer COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateViscometer:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}

private function storePushPull($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storePushPull');
        
        // ==================================================================
        // 0. DEBUG SEMUA INPUT STD
        // ==================================================================
        \Log::info('🔍 DEBUG STD INPUTS:', [
            'std_1' => $request->std_1 ?? 'NULL',
            'std_2' => $request->std_2 ?? 'NULL',
            'std_3' => $request->std_3 ?? 'NULL',
            'std_4' => $request->std_4 ?? 'NULL',
            'std_5' => $request->std_5 ?? 'NULL',
            'std_6' => $request->std_6 ?? 'NULL',
            'std_7' => $request->std_7 ?? 'NULL',
            'std_8' => $request->std_8 ?? 'NULL',
            'std_9' => $request->std_9 ?? 'NULL',
            'std_10' => $request->std_10 ?? 'NULL',
        ]);

        // ==================================================================
        // 1. PROSES ALAT STANDAR
        // ==================================================================
         $textValue  = trim($request->alat_standar_text ?? '');
            $arrayValue = $request->input('alat_standar', []); // bisa null atau array

        if (!empty($textValue)) {
            $standardValue = $textValue; // Prioritas: textarea (yang dipakai sekarang)
        } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
            $standardValue = implode("\n", $arrayValue); // Fallback ke checkbox
        } else {
            $standardValue = '';
        }
        // ==================================================================
        // 2. SIMPAN KE HEAD PUSH PULL
        // ==================================================================
        $head = HeadPushpull::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-34',
            'satuan_titik_ukur' => $request->satuan_titik_ukur ?? '',
            'satuan_tarik' => $request->satuan_pembacaan_tarik ?? '',
            'satuan_tekan' => $request->satuan_pembacaan_tekan ?? '',
        ]);

        \Log::info('✅ HeadPushpull saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL MEASUREMENTS - PERBAIKAN BESAR DI SINI
        // ==================================================================
        \Log::info('📊 Saving DetailPushpull detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 10; $i++) { // HANYA 10 BARIS (sesuai form)
            // Ambil data
            $titikUkur = $request->{"titik_ukur_$i"} ?? null;
            $std = $request->{"std_$i"} ?? null;
            
            // Data tarik
            $tarik01 = $request->{"tarik_{$i}_1"} ?? null;
            $tarik02 = $request->{"tarik_{$i}_2"} ?? null;
            $tarik03 = $request->{"tarik_{$i}_3"} ?? null;
            
            // Data tekan
            $tekan01 = $request->{"tekan_{$i}_1"} ?? null;
            $tekan02 = $request->{"tekan_{$i}_2"} ?? null;
            $tekan03 = $request->{"tekan_{$i}_3"} ?? null;
            
            // Debug setiap baris
            \Log::debug("📝 Row {$i} raw data:", [
                'titik_ukur' => $titikUkur,
                'std' => $std,
                'tarik01' => $tarik01,
                'tarik02' => $tarik02,
                'tarik03' => $tarik03,
                'tekan01' => $tekan01,
                'tekan02' => $tekan02,
                'tekan03' => $tekan03,
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($titikUkur) || !empty($std) || 
                      !empty($tarik01) || !empty($tarik02) || !empty($tarik03) || 
                      !empty($tekan01) || !empty($tekan02) || !empty($tekan03);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    // 'head_id' => $head->id, // HAPUS INI - Model tidak punya head_id
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'STD' => $std, // ✅ GUNAKAN 'STD' bukan 'std'
                    'ulanganTarik01' => $this->formatNumericValue($tarik01),
                    'ulanganTarik02' => $this->formatNumericValue($tarik02),
                    'ulanganTarik03' => $this->formatNumericValue($tarik03),
                    'ulanganTekan01' => $this->formatNumericValue($tekan01),
                    'ulanganTekan02' => $this->formatNumericValue($tekan02),
                    'ulanganTekan03' => $this->formatNumericValue($tekan03),
                ];
                
                // Debug sebelum menyimpan
                \Log::debug("💾 Saving row {$i}:", $detailData);
                
                // Simpan
                $detailRecord = DetailPushpull::create($detailData);
                $detailCount++;
                
                // Debug setelah menyimpan
                \Log::debug("✅ Saved row {$i}, ID: {$detailRecord->id}", [
                    'saved_STD' => $detailRecord->STD, // ✅ GUNAKAN STD
                    'saved_titikUkur' => $detailRecord->titikUkur
                ]);
            } else {
                \Log::debug("⏭️ Skipping row {$i} - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detail measurements for Push Pull");

        // ==================================================================
        // 4. VERIFIKASI DATA YANG DISIMPAN
        // ==================================================================
        $savedDetails = DetailPushpull::where('calibration_id', $calibration->id)->get();
        
        \Log::info('🔎 VERIFICATION - Saved details:', [
            'total_saved' => $savedDetails->count(),
            'data_sample' => $savedDetails->take(3)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkur' => $item->titikUkur,
                    'STD' => $item->STD, // ✅ GUNAKAN STD
                    'ulanganTarik01' => $item->ulanganTarik01,
                    'created_at' => $item->created_at
                ];
            })->toArray(),
            'all_STD_values' => $savedDetails->pluck('STD')->toArray() // SEMUA nilai STD
        ]);

        // ==================================================================
        // 5. SIMPAN ADD PUSH PULL
        // ==================================================================
        \Log::info('📊 Saving AddPushpull data (repeatability)...');
        
        $addData = [
            'calibration_id' => $calibration->id,
            // 'head_id' => $head->id, // HAPUS jika model tidak punya
            
            // Repeatability Tarik
            'repeatabilityTarik01' => $this->formatNumericValue($request->repeat_tarik_1 ?? null),
            'repeatabilityTarik02' => $this->formatNumericValue($request->repeat_tarik_2 ?? null),
            'repeatabilityTarik03' => $this->formatNumericValue($request->repeat_tarik_3 ?? null),
            'repeatabilityTarik04' => $this->formatNumericValue($request->repeat_tarik_4 ?? null),
            'repeatabilityTarik05' => $this->formatNumericValue($request->repeat_tarik_5 ?? null),
            'repeatabilityTarik06' => $this->formatNumericValue($request->repeat_tarik_6 ?? null),
            'repeatabilityTarik07' => $this->formatNumericValue($request->repeat_tarik_7 ?? null),
            'repeatabilityTarik08' => $this->formatNumericValue($request->repeat_tarik_8 ?? null),
            'repeatabilityTarik09' => $this->formatNumericValue($request->repeat_tarik_9 ?? null),
            'repeatabilityTarik10' => $this->formatNumericValue($request->repeat_tarik_10 ?? null),
            
            // Repeatability Tekan
            'repeatabilityTekan01' => $this->formatNumericValue($request->repeat_tekan_1 ?? null),
            'repeatabilityTekan02' => $this->formatNumericValue($request->repeat_tekan_2 ?? null),
            'repeatabilityTekan03' => $this->formatNumericValue($request->repeat_tekan_3 ?? null),
            'repeatabilityTekan04' => $this->formatNumericValue($request->repeat_tekan_4 ?? null),
            'repeatabilityTekan05' => $this->formatNumericValue($request->repeat_tekan_5 ?? null),
            'repeatabilityTekan06' => $this->formatNumericValue($request->repeat_tekan_6 ?? null),
            'repeatabilityTekan07' => $this->formatNumericValue($request->repeat_tekan_7 ?? null),
            'repeatabilityTekan08' => $this->formatNumericValue($request->repeat_tekan_8 ?? null),
            'repeatabilityTekan09' => $this->formatNumericValue($request->repeat_tekan_9 ?? null),
            'repeatabilityTekan10' => $this->formatNumericValue($request->repeat_tekan_10 ?? null),
        ];
        
        // Cek data untuk disimpan
        $hasAddData = false;
        foreach ($addData as $key => $value) {
            if (!in_array($key, ['calibration_id']) && $value !== null) {
                $hasAddData = true;
                break;
            }
        }
        
        if ($hasAddData) {
            $addRecord = AddPushpull::create($addData);
            \Log::info('✅ AddPushpull saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddPushpull data to save');
        }

        // ==================================================================
        // 6. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if ($request->filled('calibrated_by')) {
            $updateData['calibrated_by'] = $request->calibrated_by;
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 7. FINAL VERIFICATION
        // ==================================================================
        $allDetails = DetailPushpull::where('calibration_id', $calibration->id)->get();
        
        \Log::info('🏁 FINAL VERIFICATION:', [
            'calibration_id' => $calibration->id,
            'total_details' => $allDetails->count(),
            'STD_values' => $allDetails->pluck('STD')->toArray(),
            'first_record_full' => $allDetails->first() ? $allDetails->first()->toArray() : null
        ]);

        \Log::info('🎉 storePushPull COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storePushPull:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        throw new \Exception("Gagal menyimpan data Push Pull: " . $e->getMessage());
    }
}

private function updatePushPull($request, $calibration)
{
    try {
        \Log::info('🚀 START updatePushPull');
        
        // ==================================================================
        // 1. UPDATE HEAD PUSH PULL
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        if ($head = $calibration->headPushpull) {
            $head->update([
                'standard' => $alatStandarString,
            ]);
            \Log::info('✅ HeadPushpull updated:', ['standard' => $alatStandarString]);
        } else {
            // Jika head belum ada, buat baru
            $head = HeadPushpull::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-34',
            ]);
            \Log::info('➕ HeadPushpull created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL PUSH PULL (DELETE & RECREATE)
        // ==================================================================
        // Hapus data detail lama
        DetailPushpull::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        // Proses 11 baris
        for ($i = 1; $i <= 11; $i++) {
            $titikUkur = $request->{"titik_ukur_$i"} ?? null;
            $std = $request->{"std_$i"} ?? null;
            
            // Data tarik (pull)
            $tarik01 = $request->{"tarik_{$i}_1"} ?? null;
            $tarik02 = $request->{"tarik_{$i}_2"} ?? null;
            $tarik03 = $request->{"tarik_{$i}_3"} ?? null;
            
            // Data tekan (push)
            $tekan01 = $request->{"tekan_{$i}_1"} ?? null;
            $tekan02 = $request->{"tekan_{$i}_2"} ?? null;
            $tekan03 = $request->{"tekan_{$i}_3"} ?? null;
            
            $hasData = !empty($titikUkur) || !empty($std) || !empty($tarik01) || !empty($tarik02) || 
                      !empty($tarik03) || !empty($tekan01) || !empty($tekan02) || !empty($tekan03);
            
            if ($hasData) {
                DetailPushpull::create([
                    'calibration_id' => $calibration->id,
                    'head_pushpull_id' => $head->id,
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'STD' => $this->formatNumericValue($std),
                    'ulanganTarik01' => $this->formatNumericValue($tarik01),
                    'ulanganTarik02' => $this->formatNumericValue($tarik02),
                    'ulanganTarik03' => $this->formatNumericValue($tarik03),
                    'ulanganTekan01' => $this->formatNumericValue($tekan01),
                    'ulanganTekan02' => $this->formatNumericValue($tekan02),
                    'ulanganTekan03' => $this->formatNumericValue($tekan03),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ DetailPushpull updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE ADD PUSH PULL - SESUAI NAMA FIELD HTML
        // ==================================================================
        if ($addPushpull = $calibration->addPushpull) {
            $addPushpull->update([
                // Repeatability Tarik - sesuai name field HTML
                'repeatabilityTarik01' => $this->formatNumericValue($request->repeat_tarik_1 ?? $addPushpull->repeatabilityTarik01),
                'repeatabilityTarik02' => $this->formatNumericValue($request->repeat_tarik_2 ?? $addPushpull->repeatabilityTarik02),
                'repeatabilityTarik03' => $this->formatNumericValue($request->repeat_tarik_3 ?? $addPushpull->repeatabilityTarik03),
                'repeatabilityTarik04' => $this->formatNumericValue($request->repeat_tarik_4 ?? $addPushpull->repeatabilityTarik04),
                'repeatabilityTarik05' => $this->formatNumericValue($request->repeat_tarik_5 ?? $addPushpull->repeatabilityTarik05),
                'repeatabilityTarik06' => $this->formatNumericValue($request->repeat_tarik_6 ?? $addPushpull->repeatabilityTarik06),
                'repeatabilityTarik07' => $this->formatNumericValue($request->repeat_tarik_7 ?? $addPushpull->repeatabilityTarik07),
                'repeatabilityTarik08' => $this->formatNumericValue($request->repeat_tarik_8 ?? $addPushpull->repeatabilityTarik08),
                'repeatabilityTarik09' => $this->formatNumericValue($request->repeat_tarik_9 ?? $addPushpull->repeatabilityTarik09),
                'repeatabilityTarik10' => $this->formatNumericValue($request->repeat_tarik_10 ?? $addPushpull->repeatabilityTarik10),
                
                // Repeatability Tekan - sesuai name field HTML
                'repeatabilityTekan01' => $this->formatNumericValue($request->repeat_tekan_1 ?? $addPushpull->repeatabilityTekan01),
                'repeatabilityTekan02' => $this->formatNumericValue($request->repeat_tekan_2 ?? $addPushpull->repeatabilityTekan02),
                'repeatabilityTekan03' => $this->formatNumericValue($request->repeat_tekan_3 ?? $addPushpull->repeatabilityTekan03),
                'repeatabilityTekan04' => $this->formatNumericValue($request->repeat_tekan_4 ?? $addPushpull->repeatabilityTekan04),
                'repeatabilityTekan05' => $this->formatNumericValue($request->repeat_tekan_5 ?? $addPushpull->repeatabilityTekan05),
                'repeatabilityTekan06' => $this->formatNumericValue($request->repeat_tekan_6 ?? $addPushpull->repeatabilityTekan06),
                'repeatabilityTekan07' => $this->formatNumericValue($request->repeat_tekan_7 ?? $addPushpull->repeatabilityTekan07),
                'repeatabilityTekan08' => $this->formatNumericValue($request->repeat_tekan_8 ?? $addPushpull->repeatabilityTekan08),
                'repeatabilityTekan09' => $this->formatNumericValue($request->repeat_tekan_9 ?? $addPushpull->repeatabilityTekan09),
                'repeatabilityTekan10' => $this->formatNumericValue($request->repeat_tekan_10 ?? $addPushpull->repeatabilityTekan10),
            ]);
            \Log::info('✅ AddPushpull updated');
        } else {
            // Buat baru jika belum ada
            $addData = [
                'calibration_id' => $calibration->id,
                // Repeatability Tarik - sesuai name field HTML
                'repeatabilityTarik01' => $this->formatNumericValue($request->repeat_tarik_1 ?? null),
                'repeatabilityTarik02' => $this->formatNumericValue($request->repeat_tarik_2 ?? null),
                'repeatabilityTarik03' => $this->formatNumericValue($request->repeat_tarik_3 ?? null),
                'repeatabilityTarik04' => $this->formatNumericValue($request->repeat_tarik_4 ?? null),
                'repeatabilityTarik05' => $this->formatNumericValue($request->repeat_tarik_5 ?? null),
                'repeatabilityTarik06' => $this->formatNumericValue($request->repeat_tarik_6 ?? null),
                'repeatabilityTarik07' => $this->formatNumericValue($request->repeat_tarik_7 ?? null),
                'repeatabilityTarik08' => $this->formatNumericValue($request->repeat_tarik_8 ?? null),
                'repeatabilityTarik09' => $this->formatNumericValue($request->repeat_tarik_9 ?? null),
                'repeatabilityTarik10' => $this->formatNumericValue($request->repeat_tarik_10 ?? null),
                
                // Repeatability Tekan - sesuai name field HTML
                'repeatabilityTekan01' => $this->formatNumericValue($request->repeat_tekan_1 ?? null),
                'repeatabilityTekan02' => $this->formatNumericValue($request->repeat_tekan_2 ?? null),
                'repeatabilityTekan03' => $this->formatNumericValue($request->repeat_tekan_3 ?? null),
                'repeatabilityTekan04' => $this->formatNumericValue($request->repeat_tekan_4 ?? null),
                'repeatabilityTekan05' => $this->formatNumericValue($request->repeat_tekan_5 ?? null),
                'repeatabilityTekan06' => $this->formatNumericValue($request->repeat_tekan_6 ?? null),
                'repeatabilityTekan07' => $this->formatNumericValue($request->repeat_tekan_7 ?? null),
                'repeatabilityTekan08' => $this->formatNumericValue($request->repeat_tekan_8 ?? null),
                'repeatabilityTekan09' => $this->formatNumericValue($request->repeat_tekan_9 ?? null),
                'repeatabilityTekan10' => $this->formatNumericValue($request->repeat_tekan_10 ?? null),
            ];
            
            $hasAddData = false;
            foreach ($addData as $key => $value) {
                if ($key !== 'calibration_id' && $value !== null) {
                    $hasAddData = true;
                    break;
                }
            }
            
            if ($hasAddData) {
                AddPushpull::create($addData);
                \Log::info('➕ AddPushpull created baru');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if ($request->filled('calibrated_by')) {
            $updateData['calibrated_by'] = $request->calibrated_by;
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailPushpull::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddPushpull::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Push Pull):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'standard' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updatePushPull COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updatePushPull:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}


private function storeTimbangan($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeTimbangan');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Timbangan:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD TIMBANGAN
        // ==================================================================
        $head = HeadTimbangan::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)',
            'note' => $request->catatan_penting ?? null,
        ]);

        \Log::info('✅ HeadTimbangan saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL TIMBANGAN (10 BARIS SESUAI FORM)
        // ==================================================================
        \Log::info('📊 Saving DetailTimbangan data (10 rows)...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 10; $i++) {
           
            $titikUkur = $request->input("skala_nominal_$i"); 
            
         
            $Lz1 = $request->input("z1_1_$i");
            
            
            $Lm1 = $request->input("m1_1_$i");
            
            
            $Rm1 = $request->input("m1_2_$i");
            
         
            $Rz1 = $request->input("z1_2_$i");
            
            
            $STD = $request->input("standar_$i");
            
            \Log::debug("🔍 Row {$i} data from request:", [
                'skala_nominal' => $titikUkur,
                'z1_1' => $Lz1,
                'm1_1' => $Lm1,
                'm1_2' => $Rm1,
                'z1_2' => $Rz1,
                'standar' => $STD,
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($titikUkur) || !empty($STD) || 
                      !empty($Lm1) || !empty($Lz1) || 
                      !empty($Rm1) || !empty($Rz1);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'head_timbangan_id' => $head->id,
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'STD' => $this->formatNumericValue($STD),
                    'Lm1' => $this->formatNumericValue($Lm1),
                    'Lz1' => $this->formatNumericValue($Lz1),
                    'Rm1' => $this->formatNumericValue($Rm1),
                    'Rz1' => $this->formatNumericValue($Rz1),
                ];
                
                \Log::debug("💾 Saving DetailTimbangan row {$i}:", $detailData);
                
                DetailTimbangan::create($detailData);
                $detailCount++;
            } else {
                \Log::debug("⏭️ Skipping row {$i} - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailTimbangan records");

        // ==================================================================
        // 4. SIMPAN ADD TIMBANGAN (DATA REPEATABILITY DAN OFFCENTER)
        // ==================================================================
        \Log::info('📊 Saving AddTimbangan data...');
        
        $addData = [
            'calibration_id' => $calibration->id,
            
            // Setengah Kap. Max - Penunjukan z1 (sesuai form: input name="setengah_z1_1" sampai "setengah_z1_10")
            'HalfMax_z1_01' => $this->formatNumericValue($request->input('setengah_z1_1')),
            'HalfMax_z1_02' => $this->formatNumericValue($request->input('setengah_z1_2')),
            'HalfMax_z1_03' => $this->formatNumericValue($request->input('setengah_z1_3')),
            'HalfMax_z1_04' => $this->formatNumericValue($request->input('setengah_z1_4')),
            'HalfMax_z1_05' => $this->formatNumericValue($request->input('setengah_z1_5')),
            'HalfMax_z1_06' => $this->formatNumericValue($request->input('setengah_z1_6')),
            'HalfMax_z1_07' => $this->formatNumericValue($request->input('setengah_z1_7')),
            'HalfMax_z1_08' => $this->formatNumericValue($request->input('setengah_z1_8')),
            'HalfMax_z1_09' => $this->formatNumericValue($request->input('setengah_z1_9')),
            'HalfMax_z1_10' => $this->formatNumericValue($request->input('setengah_z1_10')),
            
            // Setengah Kap. Max - Penunjukan m1 (sesuai form: input name="setengah_m1_1" sampai "setengah_m1_10")
            'HalfMax_m1_01' => $this->formatNumericValue($request->input('setengah_m1_1')),
            'HalfMax_m1_02' => $this->formatNumericValue($request->input('setengah_m1_2')),
            'HalfMax_m1_03' => $this->formatNumericValue($request->input('setengah_m1_3')),
            'HalfMax_m1_04' => $this->formatNumericValue($request->input('setengah_m1_4')),
            'HalfMax_m1_05' => $this->formatNumericValue($request->input('setengah_m1_5')),
            'HalfMax_m1_06' => $this->formatNumericValue($request->input('setengah_m1_6')),
            'HalfMax_m1_07' => $this->formatNumericValue($request->input('setengah_m1_7')),
            'HalfMax_m1_08' => $this->formatNumericValue($request->input('setengah_m1_8')),
            'HalfMax_m1_09' => $this->formatNumericValue($request->input('setengah_m1_9')),
            'HalfMax_m1_10' => $this->formatNumericValue($request->input('setengah_m1_10')),
            
            // Kapasitas Max - Penunjukan z1 (sesuai form: input name="kapasitas_z1_1" sampai "kapasitas_z1_10")
            'FullMax_z1_01' => $this->formatNumericValue($request->input('kapasitas_z1_1')),
            'FullMax_z1_02' => $this->formatNumericValue($request->input('kapasitas_z1_2')),
            'FullMax_z1_03' => $this->formatNumericValue($request->input('kapasitas_z1_3')),
            'FullMax_z1_04' => $this->formatNumericValue($request->input('kapasitas_z1_4')),
            'FullMax_z1_05' => $this->formatNumericValue($request->input('kapasitas_z1_5')),
            'FullMax_z1_06' => $this->formatNumericValue($request->input('kapasitas_z1_6')),
            'FullMax_z1_07' => $this->formatNumericValue($request->input('kapasitas_z1_7')),
            'FullMax_z1_08' => $this->formatNumericValue($request->input('kapasitas_z1_8')),
            'FullMax_z1_09' => $this->formatNumericValue($request->input('kapasitas_z1_9')),
            'FullMax_z1_10' => $this->formatNumericValue($request->input('kapasitas_z1_10')),
            
            // Kapasitas Max - Penunjukan m1 (sesuai form: input name="kapasitas_m1_1" sampai "kapasitas_m1_10")
            'FullMax_m1_01' => $this->formatNumericValue($request->input('kapasitas_m1_1')),
            'FullMax_m1_02' => $this->formatNumericValue($request->input('kapasitas_m1_2')),
            'FullMax_m1_03' => $this->formatNumericValue($request->input('kapasitas_m1_3')),
            'FullMax_m1_04' => $this->formatNumericValue($request->input('kapasitas_m1_4')),
            'FullMax_m1_05' => $this->formatNumericValue($request->input('kapasitas_m1_5')),
            'FullMax_m1_06' => $this->formatNumericValue($request->input('kapasitas_m1_6')),
            'FullMax_m1_07' => $this->formatNumericValue($request->input('kapasitas_m1_7')),
            'FullMax_m1_08' => $this->formatNumericValue($request->input('kapasitas_m1_8')),
            'FullMax_m1_09' => $this->formatNumericValue($request->input('kapasitas_m1_9')),
            'FullMax_m1_10' => $this->formatNumericValue($request->input('kapasitas_m1_10')),
            
            // Off Center Data (sesuai dengan form Off-Center Loading Test)
            'bebanOffCenter' => $this->formatNumericValue($request->input('beban_timbangan')), // input name="beban_timbangan"
            'offCenterFront' => $this->formatNumericValue($request->input('beban_depan')),     // input name="beban_depan"
            'offCenterMiddle' => $this->formatNumericValue($request->input('beban_tengah')),   // input name="beban_tengah"
            'offCenterBack' => $this->formatNumericValue($request->input('beban_belakang')),   // input name="beban_belakang"
            'offCenterRight' => $this->formatNumericValue($request->input('beban_kanan')),     // input name="beban_kanan"
            'offCenterLeft' => $this->formatNumericValue($request->input('beban_kiri')),       // input name="beban_kiri"
        ];
        
        // Debug untuk melihat data yang diterima dari form
        \Log::debug('🔍 Debug AddTimbangan input data:', [
            'setengah_z1_1' => $request->input('setengah_z1_1'),
            'setengah_m1_10' => $request->input('setengah_m1_10'),
            'kapasitas_z1_1' => $request->input('kapasitas_z1_1'),
            'kapasitas_m1_10' => $request->input('kapasitas_m1_10'),
            'beban_timbangan' => $request->input('beban_timbangan'),
            'catatan_penting' => $request->input('catatan_penting'),
        ]);
        
        // Cek apakah ada data untuk disimpan
        $hasAddData = false;
        foreach ($addData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasAddData = true;
                break;
            }
        }
        
        if ($hasAddData) {
            $addRecord = AddTimbangan::create($addData);
            \Log::info('✅ AddTimbangan saved:', ['add_id' => $addRecord->id]);
            
            // Debug log untuk memastikan data tersimpan
            \Log::debug('📝 AddTimbangan saved data sample:', [
                'HalfMax_z1_01' => $addRecord->HalfMax_z1_01,
                'HalfMax_m1_10' => $addRecord->HalfMax_m1_10,
                'FullMax_z1_01' => $addRecord->FullMax_z1_01,
                'FullMax_m1_10' => $addRecord->FullMax_m1_10,
                'bebanOffCenter' => $addRecord->bebanOffCenter,
            ]);
        } else {
            \Log::info('⚠️ No AddTimbangan data to save - all fields are null');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
            \Log::info('📝 Uncertainty data:', ['uncertainty' => $request->uncertainty]);
        }
        
        // Nama untuk TTD
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->nama_dikalibrasi]);
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->nama_diperiksa]);
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailTimbangan::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddTimbangan::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Timbangan):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
            'note' => $request->input('catatan_penting'),
        ]);

        \Log::info('🎉 storeTimbangan COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeTimbangan:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailTimbangan::where('calibration_id', $calibration->id)->delete();
                AddTimbangan::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Timbangan: " . $e->getMessage());
    }
}

private function updateTimbangan($request, $calibration)
{
    try {
        \Log::info('🚀 START updateTimbangan');
        
        // ==================================================================
        // 1. UPDATE HEAD TIMBANGAN
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        if ($head = $calibration->headTimbangan) {
            $head->update([
                'standard' => $alatStandarString,
                'note' => $request->catatan_penting ?? $head->note, // Sesuai dengan textarea di form
            ]);
            \Log::info('✅ HeadTimbangan updated:', ['standard' => $alatStandarString]);
        } else {
            // Jika head belum ada, buat baru
            $head = HeadTimbangan::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-XX (Metode Kalibrasi Timbangan)',
                'note' => $request->catatan_penting ?? null,
            ]);
            \Log::info('➕ HeadTimbangan created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL TIMBANGAN (DELETE & RECREATE - 10 BARIS)
        // ==================================================================
        // Hapus data detail lama
        DetailTimbangan::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        // Proses 10 baris (sesuai dengan form)
        for ($i = 1; $i <= 10; $i++) {
            // Ambil data sesuai nama inputan di form HTML
            $titikUkur = $request->{"skala_nominal_$i"} ?? null;
            $STD = $request->{"standar_$i"} ?? null;
            $Lm1 = $request->{"m1_1_$i"} ?? null;
            $Lz1 = $request->{"z1_1_$i"} ?? null;
            $Rm1 = $request->{"m1_2_$i"} ?? null;
            $Rz1 = $request->{"z1_2_$i"} ?? null;
            
            $hasData = !empty($titikUkur) || !empty($STD) || 
                      !empty($Lm1) || !empty($Lz1) || 
                      !empty($Rm1) || !empty($Rz1);
            
            if ($hasData) {
                DetailTimbangan::create([
                    'calibration_id' => $calibration->id,
                    'head_timbangan_id' => $head->id,
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'STD' => $this->formatNumericValue($STD),
                    'Lm1' => $this->formatNumericValue($Lm1),
                    'Lz1' => $this->formatNumericValue($Lz1),
                    'Rm1' => $this->formatNumericValue($Rm1),
                    'Rz1' => $this->formatNumericValue($Rz1),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ DetailTimbangan updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE ADD TIMBANGAN
        // ==================================================================
        if ($addTimbangan = $calibration->addTimbangan) {
            $updateData = [
                // Setengah Kap. Max - Penunjukan z1
                'HalfMax_z1_01' => $this->formatNumericValue($request->setengah_z1_1 ?? $addTimbangan->HalfMax_z1_01),
                'HalfMax_z1_02' => $this->formatNumericValue($request->setengah_z1_2 ?? $addTimbangan->HalfMax_z1_02),
                'HalfMax_z1_03' => $this->formatNumericValue($request->setengah_z1_3 ?? $addTimbangan->HalfMax_z1_03),
                'HalfMax_z1_04' => $this->formatNumericValue($request->setengah_z1_4 ?? $addTimbangan->HalfMax_z1_04),
                'HalfMax_z1_05' => $this->formatNumericValue($request->setengah_z1_5 ?? $addTimbangan->HalfMax_z1_05),
                'HalfMax_z1_06' => $this->formatNumericValue($request->setengah_z1_6 ?? $addTimbangan->HalfMax_z1_06),
                'HalfMax_z1_07' => $this->formatNumericValue($request->setengah_z1_7 ?? $addTimbangan->HalfMax_z1_07),
                'HalfMax_z1_08' => $this->formatNumericValue($request->setengah_z1_8 ?? $addTimbangan->HalfMax_z1_08),
                'HalfMax_z1_09' => $this->formatNumericValue($request->setengah_z1_9 ?? $addTimbangan->HalfMax_z1_09),
                'HalfMax_z1_10' => $this->formatNumericValue($request->setengah_z1_10 ?? $addTimbangan->HalfMax_z1_10),
                
                // Setengah Kap. Max - Penunjukan m1
                'HalfMax_m1_01' => $this->formatNumericValue($request->setengah_m1_1 ?? $addTimbangan->HalfMax_m1_01),
                'HalfMax_m1_02' => $this->formatNumericValue($request->setengah_m1_2 ?? $addTimbangan->HalfMax_m1_02),
                'HalfMax_m1_03' => $this->formatNumericValue($request->setengah_m1_3 ?? $addTimbangan->HalfMax_m1_03),
                'HalfMax_m1_04' => $this->formatNumericValue($request->setengah_m1_4 ?? $addTimbangan->HalfMax_m1_04),
                'HalfMax_m1_05' => $this->formatNumericValue($request->setengah_m1_5 ?? $addTimbangan->HalfMax_m1_05),
                'HalfMax_m1_06' => $this->formatNumericValue($request->setengah_m1_6 ?? $addTimbangan->HalfMax_m1_06),
                'HalfMax_m1_07' => $this->formatNumericValue($request->setengah_m1_7 ?? $addTimbangan->HalfMax_m1_07),
                'HalfMax_m1_08' => $this->formatNumericValue($request->setengah_m1_8 ?? $addTimbangan->HalfMax_m1_08),
                'HalfMax_m1_09' => $this->formatNumericValue($request->setengah_m1_9 ?? $addTimbangan->HalfMax_m1_09),
                'HalfMax_m1_10' => $this->formatNumericValue($request->setengah_m1_10 ?? $addTimbangan->HalfMax_m1_10),
                
                // Kapasitas Max - Penunjukan z1
                'FullMax_z1_01' => $this->formatNumericValue($request->kapasitas_z1_1 ?? $addTimbangan->FullMax_z1_01),
                'FullMax_z1_02' => $this->formatNumericValue($request->kapasitas_z1_2 ?? $addTimbangan->FullMax_z1_02),
                'FullMax_z1_03' => $this->formatNumericValue($request->kapasitas_z1_3 ?? $addTimbangan->FullMax_z1_03),
                'FullMax_z1_04' => $this->formatNumericValue($request->kapasitas_z1_4 ?? $addTimbangan->FullMax_z1_04),
                'FullMax_z1_05' => $this->formatNumericValue($request->kapasitas_z1_5 ?? $addTimbangan->FullMax_z1_05),
                'FullMax_z1_06' => $this->formatNumericValue($request->kapasitas_z1_6 ?? $addTimbangan->FullMax_z1_06),
                'FullMax_z1_07' => $this->formatNumericValue($request->kapasitas_z1_7 ?? $addTimbangan->FullMax_z1_07),
                'FullMax_z1_08' => $this->formatNumericValue($request->kapasitas_z1_8 ?? $addTimbangan->FullMax_z1_08),
                'FullMax_z1_09' => $this->formatNumericValue($request->kapasitas_z1_9 ?? $addTimbangan->FullMax_z1_09),
                'FullMax_z1_10' => $this->formatNumericValue($request->kapasitas_z1_10 ?? $addTimbangan->FullMax_z1_10),
                
                // Kapasitas Max - Penunjukan m1
                'FullMax_m1_01' => $this->formatNumericValue($request->kapasitas_m1_1 ?? $addTimbangan->FullMax_m1_01),
                'FullMax_m1_02' => $this->formatNumericValue($request->kapasitas_m1_2 ?? $addTimbangan->FullMax_m1_02),
                'FullMax_m1_03' => $this->formatNumericValue($request->kapasitas_m1_3 ?? $addTimbangan->FullMax_m1_03),
                'FullMax_m1_04' => $this->formatNumericValue($request->kapasitas_m1_4 ?? $addTimbangan->FullMax_m1_04),
                'FullMax_m1_05' => $this->formatNumericValue($request->kapasitas_m1_5 ?? $addTimbangan->FullMax_m1_05),
                'FullMax_m1_06' => $this->formatNumericValue($request->kapasitas_m1_6 ?? $addTimbangan->FullMax_m1_06),
                'FullMax_m1_07' => $this->formatNumericValue($request->kapasitas_m1_7 ?? $addTimbangan->FullMax_m1_07),
                'FullMax_m1_08' => $this->formatNumericValue($request->kapasitas_m1_8 ?? $addTimbangan->FullMax_m1_08),
                'FullMax_m1_09' => $this->formatNumericValue($request->kapasitas_m1_9 ?? $addTimbangan->FullMax_m1_09),
                'FullMax_m1_10' => $this->formatNumericValue($request->kapasitas_m1_10 ?? $addTimbangan->FullMax_m1_10),
                
                // Off Center Data
                'bebanOffCenter' => $this->formatNumericValue($request->beban_timbangan ?? $addTimbangan->bebanOffCenter),
                'offCenterFront' => $this->formatNumericValue($request->beban_depan ?? $addTimbangan->offCenterFront),
                'offCenterMiddle' => $this->formatNumericValue($request->beban_tengah ?? $addTimbangan->offCenterMiddle),
                'offCenterBack' => $this->formatNumericValue($request->beban_belakang ?? $addTimbangan->offCenterBack),
                'offCenterRight' => $this->formatNumericValue($request->beban_kanan ?? $addTimbangan->offCenterRight),
                'offCenterLeft' => $this->formatNumericValue($request->beban_kiri ?? $addTimbangan->offCenterLeft),
            ];
            
            $addTimbangan->update($updateData);
            \Log::info('✅ AddTimbangan updated');
        } else {
            // Buat baru jika belum ada
            $addData = [
                'calibration_id' => $calibration->id,
                
                // Setengah Kap. Max - Penunjukan z1
                'HalfMax_z1_01' => $this->formatNumericValue($request->setengah_z1_1 ?? null),
                'HalfMax_z1_02' => $this->formatNumericValue($request->setengah_z1_2 ?? null),
                'HalfMax_z1_03' => $this->formatNumericValue($request->setengah_z1_3 ?? null),
                'HalfMax_z1_04' => $this->formatNumericValue($request->setengah_z1_4 ?? null),
                'HalfMax_z1_05' => $this->formatNumericValue($request->setengah_z1_5 ?? null),
                'HalfMax_z1_06' => $this->formatNumericValue($request->setengah_z1_6 ?? null),
                'HalfMax_z1_07' => $this->formatNumericValue($request->setengah_z1_7 ?? null),
                'HalfMax_z1_08' => $this->formatNumericValue($request->setengah_z1_8 ?? null),
                'HalfMax_z1_09' => $this->formatNumericValue($request->setengah_z1_9 ?? null),
                'HalfMax_z1_10' => $this->formatNumericValue($request->setengah_z1_10 ?? null),
                
                // Setengah Kap. Max - Penunjukan m1
                'HalfMax_m1_01' => $this->formatNumericValue($request->setengah_m1_1 ?? null),
                'HalfMax_m1_02' => $this->formatNumericValue($request->setengah_m1_2 ?? null),
                'HalfMax_m1_03' => $this->formatNumericValue($request->setengah_m1_3 ?? null),
                'HalfMax_m1_04' => $this->formatNumericValue($request->setengah_m1_4 ?? null),
                'HalfMax_m1_05' => $this->formatNumericValue($request->setengah_m1_5 ?? null),
                'HalfMax_m1_06' => $this->formatNumericValue($request->setengah_m1_6 ?? null),
                'HalfMax_m1_07' => $this->formatNumericValue($request->setengah_m1_7 ?? null),
                'HalfMax_m1_08' => $this->formatNumericValue($request->setengah_m1_8 ?? null),
                'HalfMax_m1_09' => $this->formatNumericValue($request->setengah_m1_9 ?? null),
                'HalfMax_m1_10' => $this->formatNumericValue($request->setengah_m1_10 ?? null),
                
                // Kapasitas Max - Penunjukan z1
                'FullMax_z1_01' => $this->formatNumericValue($request->kapasitas_z1_1 ?? null),
                'FullMax_z1_02' => $this->formatNumericValue($request->kapasitas_z1_2 ?? null),
                'FullMax_z1_03' => $this->formatNumericValue($request->kapasitas_z1_3 ?? null),
                'FullMax_z1_04' => $this->formatNumericValue($request->kapasitas_z1_4 ?? null),
                'FullMax_z1_05' => $this->formatNumericValue($request->kapasitas_z1_5 ?? null),
                'FullMax_z1_06' => $this->formatNumericValue($request->kapasitas_z1_6 ?? null),
                'FullMax_z1_07' => $this->formatNumericValue($request->kapasitas_z1_7 ?? null),
                'FullMax_z1_08' => $this->formatNumericValue($request->kapasitas_z1_8 ?? null),
                'FullMax_z1_09' => $this->formatNumericValue($request->kapasitas_z1_9 ?? null),
                'FullMax_z1_10' => $this->formatNumericValue($request->kapasitas_z1_10 ?? null),
                
                // Kapasitas Max - Penunjukan m1
                'FullMax_m1_01' => $this->formatNumericValue($request->kapasitas_m1_1 ?? null),
                'FullMax_m1_02' => $this->formatNumericValue($request->kapasitas_m1_2 ?? null),
                'FullMax_m1_03' => $this->formatNumericValue($request->kapasitas_m1_3 ?? null),
                'FullMax_m1_04' => $this->formatNumericValue($request->kapasitas_m1_4 ?? null),
                'FullMax_m1_05' => $this->formatNumericValue($request->kapasitas_m1_5 ?? null),
                'FullMax_m1_06' => $this->formatNumericValue($request->kapasitas_m1_6 ?? null),
                'FullMax_m1_07' => $this->formatNumericValue($request->kapasitas_m1_7 ?? null),
                'FullMax_m1_08' => $this->formatNumericValue($request->kapasitas_m1_8 ?? null),
                'FullMax_m1_09' => $this->formatNumericValue($request->kapasitas_m1_9 ?? null),
                'FullMax_m1_10' => $this->formatNumericValue($request->kapasitas_m1_10 ?? null),
                
                // Off Center Data
                'bebanOffCenter' => $this->formatNumericValue($request->beban_timbangan ?? null),
                'offCenterFront' => $this->formatNumericValue($request->beban_depan ?? null),
                'offCenterMiddle' => $this->formatNumericValue($request->beban_tengah ?? null),
                'offCenterBack' => $this->formatNumericValue($request->beban_belakang ?? null),
                'offCenterRight' => $this->formatNumericValue($request->beban_kanan ?? null),
                'offCenterLeft' => $this->formatNumericValue($request->beban_kiri ?? null),
            ];
            
            $hasAddData = false;
            foreach ($addData as $key => $value) {
                if ($key !== 'calibration_id' && $value !== null) {
                    $hasAddData = true;
                    break;
                }
            }
            
            if ($hasAddData) {
                AddTimbangan::create($addData);
                \Log::info('➕ AddTimbangan created baru');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailTimbangan::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddTimbangan::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Timbangan):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'standard' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updateTimbangan COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateTimbangan:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}


private function storeTimbanganMoisture($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeTimbanganMoisture - COMBINED TEMPERATURE & WEIGHT');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Timbangan Moisture:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD TIMBANGAN MOISTURE
        // ==================================================================
        $head = HeadTimbanganMoisture::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-15 (Monograph 4 : The Calibration of Weights and Balances, NMI Australia 2010)',
        ]);

        \Log::info('✅ HeadTimbanganMoisture saved:', ['head_id' => $head->id]);

        $detailCount = 0;
        
        // ==================================================================
        // 3. SIMPAN 10 RECORD DENGAN DATA GABUNGAN (SUHU DI RECORD 1-3)
        // ==================================================================
        \Log::info('📊 Saving 10 combined records (temperature in record 1-3, weight data)...');
        
        for ($i = 1; $i <= 10; $i++) {
            // Data timbangan untuk semua record
            $titikUkur = $request->input("skala_nominal_$i"); 
            $Lz1 = $request->input("z1_1_$i");
            $Lm1 = $request->input("m1_1_$i");
            $Rm1 = $request->input("m1_2_$i");
            $Rz1 = $request->input("z1_2_$i");
            $STD = $request->input("standar_$i");
            
            // Data suhu HANYA untuk record 1-3
            $tsetting = null;
            $readAlat01 = null;
            $readAlat02 = null;
            $readAlat03 = null;
            $readSTD01 = null;
            $readSTD02 = null;
            $readSTD03 = null;
            
            if ($i <= 3) {
                // Record 1-3: tambahkan data suhu
                $settingNum = $i; // setting suhu ke-1, ke-2, ke-3 sesuai record
                $tsetting = $this->formatNumericValue($request->input("setting_suhu_{$settingNum}"));
                
                $readAlat01 = $this->formatNumericValue($request->input("pembacaan_alat_{$settingNum}_1"));
                $readAlat02 = $this->formatNumericValue($request->input("pembacaan_alat_{$settingNum}_2"));
                $readAlat03 = $this->formatNumericValue($request->input("pembacaan_alat_{$settingNum}_3"));
                
                $readSTD01 = $this->formatNumericValue($request->input("pembacaan_standar_{$settingNum}_1"));
                $readSTD02 = $this->formatNumericValue($request->input("pembacaan_standar_{$settingNum}_2"));
                $readSTD03 = $this->formatNumericValue($request->input("pembacaan_standar_{$settingNum}_3"));
                
                \Log::debug("🌡️ Record {$i}: Temperature data added", [
                    'Tsetting' => $tsetting,
                    'setting_num' => $settingNum
                ]);
            }
            
            // Cek apakah ada data untuk record ini
            $hasTimbanganData = !empty($titikUkur) || !empty($STD) || 
                              !empty($Lm1) || !empty($Lz1) || 
                              !empty($Rm1) || !empty($Rz1);
            
            $hasSuhuData = ($i <= 3) && ($tsetting !== null || $readAlat01 !== null || 
                         $readAlat02 !== null || $readAlat03 !== null ||
                         $readSTD01 !== null || $readSTD02 !== null || $readSTD03 !== null);
            
            $hasData = $hasTimbanganData || $hasSuhuData;
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    // Data timbangan
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'STD' => $this->formatNumericValue($STD),
                    'Lm1' => $this->formatNumericValue($Lm1),
                    'Lz1' => $this->formatNumericValue($Lz1),
                    'Rm1' => $this->formatNumericValue($Rm1),
                    'Rz1' => $this->formatNumericValue($Rz1),
                    // Data suhu (hanya untuk record 1-3, null untuk lainnya)
                    'Tsetting' => $tsetting,
                    'ReadAlat01' => $readAlat01,
                    'ReadAlat02' => $readAlat02,
                    'ReadAlat03' => $readAlat03,
                    'ReadSTD01' => $readSTD01,
                    'ReadSTD02' => $readSTD02,
                    'ReadSTD03' => $readSTD03,
                ];
                
                $record = DetailTimbanganMoisture::create($detailData);
                $detailCount++;
                
                \Log::debug("✅ Record {$i} saved", [
                    'record_id' => $record->id,
                    'has_temperature' => $i <= 3 ? 'YES' : 'NO',
                    'titikUkur' => $detailData['titikUkur'],
                    'Tsetting' => $detailData['Tsetting']
                ]);
            }
        }
        
        \Log::info("✅ Saved {$detailCount} combined records (temperature in record 1-3)");
        
        // ==================================================================
        // 4. SIMPAN ADD TIMBANGAN MOISTURE
        // ==================================================================
        \Log::info('📊 Saving AddTimbanganMoisture data...');
        
        $addData = [
            'calibration_id' => $calibration->id,
            
            // Pemeriksaan Nilai Repeatability - Setengah Kap. Max
            'HalfMax_z1_01' => $this->formatNumericValue($request->input('setengah_z1_1')),
            'HalfMax_z1_02' => $this->formatNumericValue($request->input('setengah_z1_2')),
            'HalfMax_z1_03' => $this->formatNumericValue($request->input('setengah_z1_3')),
            'HalfMax_z1_04' => $this->formatNumericValue($request->input('setengah_z1_4')),
            'HalfMax_z1_05' => $this->formatNumericValue($request->input('setengah_z1_5')),
            'HalfMax_z1_06' => $this->formatNumericValue($request->input('setengah_z1_6')),
            'HalfMax_z1_07' => $this->formatNumericValue($request->input('setengah_z1_7')),
            'HalfMax_z1_08' => $this->formatNumericValue($request->input('setengah_z1_8')),
            'HalfMax_z1_09' => $this->formatNumericValue($request->input('setengah_z1_9')),
            'HalfMax_z1_10' => $this->formatNumericValue($request->input('setengah_z1_10')),
            
            'HalfMax_m1_01' => $this->formatNumericValue($request->input('setengah_m1_1')),
            'HalfMax_m1_02' => $this->formatNumericValue($request->input('setengah_m1_2')),
            'HalfMax_m1_03' => $this->formatNumericValue($request->input('setengah_m1_3')),
            'HalfMax_m1_04' => $this->formatNumericValue($request->input('setengah_m1_4')),
            'HalfMax_m1_05' => $this->formatNumericValue($request->input('setengah_m1_5')),
            'HalfMax_m1_06' => $this->formatNumericValue($request->input('setengah_m1_6')),
            'HalfMax_m1_07' => $this->formatNumericValue($request->input('setengah_m1_7')),
            'HalfMax_m1_08' => $this->formatNumericValue($request->input('setengah_m1_8')),
            'HalfMax_m1_09' => $this->formatNumericValue($request->input('setengah_m1_9')),
            'HalfMax_m1_10' => $this->formatNumericValue($request->input('setengah_m1_10')),
            
            // Pemeriksaan Nilai Repeatability - Kapasitas Max
            'FullMax_z1_01' => $this->formatNumericValue($request->input('kapasitas_z1_1')),
            'FullMax_z1_02' => $this->formatNumericValue($request->input('kapasitas_z1_2')),
            'FullMax_z1_03' => $this->formatNumericValue($request->input('kapasitas_z1_3')),
            'FullMax_z1_04' => $this->formatNumericValue($request->input('kapasitas_z1_4')),
            'FullMax_z1_05' => $this->formatNumericValue($request->input('kapasitas_z1_5')),
            'FullMax_z1_06' => $this->formatNumericValue($request->input('kapasitas_z1_6')),
            'FullMax_z1_07' => $this->formatNumericValue($request->input('kapasitas_z1_7')),
            'FullMax_z1_08' => $this->formatNumericValue($request->input('kapasitas_z1_8')),
            'FullMax_z1_09' => $this->formatNumericValue($request->input('kapasitas_z1_9')),
            'FullMax_z1_10' => $this->formatNumericValue($request->input('kapasitas_z1_10')),
            
            'FullMax_m1_01' => $this->formatNumericValue($request->input('kapasitas_m1_1')),
            'FullMax_m1_02' => $this->formatNumericValue($request->input('kapasitas_m1_2')),
            'FullMax_m1_03' => $this->formatNumericValue($request->input('kapasitas_m1_3')),
            'FullMax_m1_04' => $this->formatNumericValue($request->input('kapasitas_m1_4')),
            'FullMax_m1_05' => $this->formatNumericValue($request->input('kapasitas_m1_5')),
            'FullMax_m1_06' => $this->formatNumericValue($request->input('kapasitas_m1_6')),
            'FullMax_m1_07' => $this->formatNumericValue($request->input('kapasitas_m1_7')),
            'FullMax_m1_08' => $this->formatNumericValue($request->input('kapasitas_m1_8')),
            'FullMax_m1_09' => $this->formatNumericValue($request->input('kapasitas_m1_9')),
            'FullMax_m1_10' => $this->formatNumericValue($request->input('kapasitas_m1_10')),
            
            // Off-Center Loading Test
            'bebanOffCenter' => $this->formatNumericValue($request->input('beban_timbangan')),
            'offCenterFront' => $this->formatNumericValue($request->input('beban_depan')),
            'offCenterMiddle' => $this->formatNumericValue($request->input('beban_tengah')),
            'offCenterBack' => $this->formatNumericValue($request->input('beban_belakang')),
            'offCenterRight' => $this->formatNumericValue($request->input('beban_kanan')),
            'offCenterLeft' => $this->formatNumericValue($request->input('beban_kiri')),
        ];
        
        // Cek apakah ada data untuk disimpan
        $hasAddData = false;
        foreach ($addData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasAddData = true;
                break;
            }
        }
        
        if ($hasAddData) {
            $addRecord = AddTimbanganMoisture::create($addData);
            \Log::info('✅ AddTimbanganMoisture saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddTimbanganMoisture data to save');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailTimbanganMoisture::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddTimbanganMoisture::where('calibration_id', $calibration->id)->count();
        
        // Cek record yang memiliki data suhu
        $temperatureRecords = DetailTimbanganMoisture::where('calibration_id', $calibration->id)
            ->where(function($query) {
                $query->whereNotNull('Tsetting')
                      ->orWhereNotNull('ReadAlat01')
                      ->orWhereNotNull('ReadAlat02')
                      ->orWhereNotNull('ReadAlat03')
                      ->orWhereNotNull('ReadSTD01')
                      ->orWhereNotNull('ReadSTD02')
                      ->orWhereNotNull('ReadSTD03');
            })
            ->count();
        
        \Log::info('📋 STORE SUMMARY (Timbangan Moisture - COMBINED DATA):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'total_records' => $savedDetailCount,
            'records_with_temperature' => $temperatureRecords . ' (should be 1-3)',
            'record_structure' => '✅ ALL 10 records have weight data, records 1-3 ALSO have temperature data',
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
        ]);

        \Log::info('🎉 storeTimbanganMoisture COMPLETED (COMBINED TEMPERATURE & WEIGHT)');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeTimbanganMoisture:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailTimbanganMoisture::where('calibration_id', $calibration->id)->delete();
                AddTimbanganMoisture::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Timbangan Moisture: " . $e->getMessage());
    }
}



private function storeTimbanganBias($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeTimbanganBias');
        
       // ==================================================================
        // 1. PROSES ALAT STANDAR - NILAI FIX/TETAP
        // ==================================================================
        $alatStandarString = 'Anak Timbang Kelas M1 | M2';
        $calibrationMethod = 'The Calibration of Weight and Balance, Third Edition - NMI Australia.';
        
        \Log::info('🔧 Alat standar FIXED:', [
            'alat_standar' => $alatStandarString,
            'method' => $calibrationMethod
        ]);

        // ==================================================================
        // 2. SIMPAN KE HEAD TIMBANGAN BIAS
        // ==================================================================
        $head = HeadTimbanganBias::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString, // Nilai fixed
            'calibrationMethod' => $calibrationMethod, // Nilai fixed
            'note' => $request->catatan ?? null,
        ]);

        \Log::info('✅ HeadTimbanganBias saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL TIMBANGAN BIAS - SESUAIKAN DENGAN NAMA INPUT HTML
        // ==================================================================
        \Log::info('📊 Saving DetailTimbanganBias data...');
        $detailCount = 0;

        // Array mapping untuk mengkonversi nama input HTML ke field database
        $dataMapping = [
            // Baris Umum (z M M z) - ini adalah baris pertama di HTML
            [
                'titik_ukir' => 'titik_umum', // Dari HTML: name="titik_umum"
                'Lz1' => 'val_z_umum',        // Dari HTML: name="val_z_umum"
                'Lm1' => 'val_m1_umum',       // Dari HTML: name="val_m1_umum"
                'Rm1' => 'val_m2_umum',       // Dari HTML: name="val_m2_umum"
                'Rz1' => 'val_z2_umum',       // Dari HTML: name="val_z2_umum"
                'STD' => 'standar_umum',      // Dari HTML: name="standar_umum"
            ],
            // Titik 1 sampai 9
            [
                'titik_ukir' => 'titik_1',
                'Lz1' => 'val_z_1',
                'Lm1' => 'val_m1_1',
                'Rm1' => 'val_m2_1',
                'Rz1' => 'val_z2_1',
                'STD' => 'standar_1',
            ],
            [
                'titik_ukir' => 'titik_2',
                'Lz1' => 'val_z_2',
                'Lm1' => 'val_m1_2',
                'Rm1' => 'val_m2_2',
                'Rz1' => 'val_z2_2',
                'STD' => 'standar_2',
            ],
            [
                'titik_ukir' => 'titik_3',
                'Lz1' => 'val_z_3',
                'Lm1' => 'val_m1_3',
                'Rm1' => 'val_m2_3',
                'Rz1' => 'val_z2_3',
                'STD' => 'standar_3',
            ],
            [
                'titik_ukir' => 'titik_4',
                'Lz1' => 'val_z_4',
                'Lm1' => 'val_m1_4',
                'Rm1' => 'val_m2_4',
                'Rz1' => 'val_z2_4',
                'STD' => 'standar_4',
            ],
            [
                'titik_ukir' => 'titik_5',
                'Lz1' => 'val_z_5',
                'Lm1' => 'val_m1_5',
                'Rm1' => 'val_m2_5',
                'Rz1' => 'val_z2_5',
                'STD' => 'standar_5',
            ],
            [
                'titik_ukir' => 'titik_6',
                'Lz1' => 'val_z_6',
                'Lm1' => 'val_m1_6',
                'Rm1' => 'val_m2_6',
                'Rz1' => 'val_z2_6',
                'STD' => 'standar_6',
            ],
            [
                'titik_ukir' => 'titik_7',
                'Lz1' => 'val_z_7',
                'Lm1' => 'val_m1_7',
                'Rm1' => 'val_m2_7',
                'Rz1' => 'val_z2_7',
                'STD' => 'standar_7',
            ],
            [
                'titik_ukir' => 'titik_8',
                'Lz1' => 'val_z_8',
                'Lm1' => 'val_m1_8',
                'Rm1' => 'val_m2_8',
                'Rz1' => 'val_z2_8',
                'STD' => 'standar_8',
            ],
            [
                'titik_ukir' => 'titik_9',
                'Lz1' => 'val_z_9',
                'Lm1' => 'val_m1_9',
                'Rm1' => 'val_m2_9',
                'Rz1' => 'val_z2_9',
                'STD' => 'standar_9',
            ]
        ];
        
        foreach ($dataMapping as $index => $mapping) {
            // Ambil data dari request sesuai nama input di HTML
            $titikUkur = $request->input($mapping['titik_ukir']);
            $Lz1 = $request->input($mapping['Lz1']);
            $Lm1 = $request->input($mapping['Lm1']);
            $Rm1 = $request->input($mapping['Rm1']);
            $Rz1 = $request->input($mapping['Rz1']);
            $STD = $request->input($mapping['STD']);
            
            \Log::debug("🔍 Row " . ($index + 1) . " data from request:", [
                'titik_ukir' => $titikUkur,
                'Lz1' => $Lz1,
                'Lm1' => $Lm1,
                'Rm1' => $Rm1,
                'Rz1' => $Rz1,
                'STD' => $STD,
                'input_names' => $mapping
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($titikUkur) || !empty($STD) || 
                      !empty($Lm1) || !empty($Lz1) || 
                      !empty($Rm1) || !empty($Rz1);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'STD' => $this->formatNumericValue($STD),
                    'Lm1' => $this->formatNumericValue($Lm1),
                    'Lz1' => $this->formatNumericValue($Lz1),
                    'Rm1' => $this->formatNumericValue($Rm1),
                    'Rz1' => $this->formatNumericValue($Rz1),
                ];
                
                \Log::debug("💾 Saving DetailTimbanganBias row " . ($index + 1) . ":", $detailData);
                
                DetailTimbanganBias::create($detailData);
                $detailCount++;
            } else {
                \Log::debug("⏭️ Skipping row " . ($index + 1) . " - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailTimbanganBias records");

        // ==================================================================
        // 4. SIMPAN ADD TIMBANGAN BIAS (DATA REPEATABILITY DAN OFFCENTER)
        // ==================================================================
        \Log::info('📊 Saving AddTimbanganBias data...');
        
        // Pastikan nama-nama ini sesuai dengan input di form lain
        // Jika nama input berbeda, sesuaikan di sini
        
        $addData = [
            'calibration_id' => $calibration->id,
            
            // Asumsi nama input di form lain tetap sama
            'HalfMax_m1_01' => $this->formatNumericValue($request->input('setengah_mi_1')),
            'HalfMax_m1_02' => $this->formatNumericValue($request->input('setengah_mi_2')),
            'HalfMax_m1_03' => $this->formatNumericValue($request->input('setengah_mi_3')),
            'HalfMax_m1_04' => $this->formatNumericValue($request->input('setengah_mi_4')),
            'HalfMax_m1_05' => $this->formatNumericValue($request->input('setengah_mi_5')),
            'HalfMax_m1_06' => $this->formatNumericValue($request->input('setengah_mi_6')),
            'HalfMax_m1_07' => $this->formatNumericValue($request->input('setengah_mi_7')),
            'HalfMax_m1_08' => $this->formatNumericValue($request->input('setengah_mi_8')),
            'HalfMax_m1_09' => $this->formatNumericValue($request->input('setengah_mi_9')),
            'HalfMax_m1_10' => $this->formatNumericValue($request->input('setengah_mi_10')),
            'FullMax_m1_01' => $this->formatNumericValue($request->input('kapasitas_mi_1')),
            'FullMax_m1_02' => $this->formatNumericValue($request->input('kapasitas_mi_2')),
            'FullMax_m1_03' => $this->formatNumericValue($request->input('kapasitas_mi_3')),
            'FullMax_m1_04' => $this->formatNumericValue($request->input('kapasitas_mi_4')),
            'FullMax_m1_05' => $this->formatNumericValue($request->input('kapasitas_mi_5')),
            'FullMax_m1_06' => $this->formatNumericValue($request->input('kapasitas_mi_6')),
            'FullMax_m1_07' => $this->formatNumericValue($request->input('kapasitas_mi_7')),
            'FullMax_m1_08' => $this->formatNumericValue($request->input('kapasitas_mi_8')),
            'FullMax_m1_09' => $this->formatNumericValue($request->input('kapasitas_mi_9')),
            'FullMax_m1_10' => $this->formatNumericValue($request->input('kapasitas_mi_10')),


            'HalfMax_z1_01' => $this->formatNumericValue($request->input('setengah_zi_1')),
            'HalfMax_z1_02' => $this->formatNumericValue($request->input('setengah_zi_2')),
            'HalfMax_z1_03' => $this->formatNumericValue($request->input('setengah_zi_3')),
            'HalfMax_z1_04' => $this->formatNumericValue($request->input('setengah_zi_4')),
            'HalfMax_z1_05' => $this->formatNumericValue($request->input('setengah_zi_5')),
            'HalfMax_z1_06' => $this->formatNumericValue($request->input('setengah_zi_6')),
            'HalfMax_z1_07' => $this->formatNumericValue($request->input('setengah_zi_7')),
            'HalfMax_z1_08' => $this->formatNumericValue($request->input('setengah_zi_8')),
            'HalfMax_z1_09' => $this->formatNumericValue($request->input('setengah_zi_9')),
            'HalfMax_z1_10' => $this->formatNumericValue($request->input('setengah_zi_10')),
            'FullMax_z1_01' => $this->formatNumericValue($request->input('kapasitas_zi_1')),
            'FullMax_z1_02' => $this->formatNumericValue($request->input('kapasitas_zi_2')),
            'FullMax_z1_03' => $this->formatNumericValue($request->input('kapasitas_zi_3')),
            'FullMax_z1_04' => $this->formatNumericValue($request->input('kapasitas_zi_4')),
            'FullMax_z1_05' => $this->formatNumericValue($request->input('kapasitas_zi_5')),
            'FullMax_z1_06' => $this->formatNumericValue($request->input('kapasitas_zi_6')),
            'FullMax_z1_07' => $this->formatNumericValue($request->input('kapasitas_zi_7')),
            'FullMax_z1_08' => $this->formatNumericValue($request->input('kapasitas_zi_8')),
            'FullMax_z1_09' => $this->formatNumericValue($request->input('kapasitas_zi_9')),
            'FullMax_z1_10' => $this->formatNumericValue($request->input('kapasitas_zi_10')),
            
            // Sesuaikan jika nama input di form berbeda
            'bebanOffCenter' => $this->formatNumericValue($request->input('beban_massa')),
            'offCenterFront' => $this->formatNumericValue($request->input('effect_depan')),
            'offCenterMiddle' => $this->formatNumericValue($request->input('effect_tengah')),
            'offCenterBack' => $this->formatNumericValue($request->input('effect_belakang')),
            'offCenterRight' => $this->formatNumericValue($request->input('effect_kanan')),
            'offCenterLeft' => $this->formatNumericValue($request->input('effect_kiri')),
        ];
        
        // Cek apakah ada data untuk disimpan
        $hasAddData = false;
        foreach ($addData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasAddData = true;
                break;
            }
        }
        
        if ($hasAddData) {
            $addRecord = AddTimbanganBias::create($addData);
            \Log::info('✅ AddTimbanganBias saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddTimbanganBias data to save');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Nama untuk TTD
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        // Data khusus timbangan bias
        if ($request->filled('bias_factor')) {
            $updateData['correction_factor'] = $request->bias_factor;
        }
        
        // Simpan beban massa ke calibration jika ada
        if ($request->filled('beban_massa')) {
            $updateData['beban_massa'] = $request->beban_massa;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailTimbanganBias::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddTimbanganBias::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Timbangan Bias):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'mapping_summary' => [
                'titik_umum → titikUkur (row 1)' => 'OK',
                'val_z_umum → Lz1' => 'OK',
                'val_m1_umum → Lm1' => 'OK',
                'val_m2_umum → Rm1' => 'OK',
                'val_z2_umum → Rz1' => 'OK',
                'standar_umum → STD' => 'OK',
                'Total rows processed' => count($dataMapping)
            ]
        ]);

        \Log::info('🎉 storeTimbanganBias COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeTimbanganBias:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback
        if (isset($head) && $head->id) {
            try {
                DetailTimbanganBias::where('calibration_id', $calibration->id)->delete();
                AddTimbanganBias::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Timbangan Bias: " . $e->getMessage());
    }
}


private function storeGaugeBlock($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeGaugeBlock');
        
        // ==================================================================
        // 1. ALAT STANDAR - DIHARDCODE (TIDAK AMBIL DARI INPUTAN)
        // ==================================================================
        $alatStandarString = 'Mesin ULM 01-600D';
        $calibrationMethod = 'PAS-IK1102-65';
        
        \Log::info('🔧 Alat standar FIXED:', [
            'alat_standar' => $alatStandarString,
            'method' => $calibrationMethod
        ]);

        // ==================================================================
        // 2. SIMPAN KE HEAD GAUGE BLOCK - DENGAN NILAI HARDCODE
        // ==================================================================
        $head = HeadGaugeBlock::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString, // Nilai fixed
            'calibrationMethod' => $calibrationMethod, // Nilai fixed
            'note' => $request->catatan ?? null, // Jika ada field catatan
        ]);

        \Log::info('✅ HeadGaugeBlock saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL GAUGE BLOCK - MENYESUAIKAN DENGAN 15 BARIS
        // ==================================================================
        \Log::info('📊 Saving DetailGaugeBlock data untuk 15 baris...');
        $detailCount = 0;

        // Proses 15 baris data sesuai dengan tabel HTML
        for ($i = 1; $i <= 15; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Data utama yang diperiksa
            $mainData = [
                'titikUkur' => $request->{"titikUkur_{$i}"} ?? null,
                'NoSeri' => $request->{"NoSeri_{$i}"} ?? null,
                'STD' => $request->{"STD_{$i}"} ?? null,
            ];
            
            foreach ($mainData as $value) {
                if ($value !== null && $value !== '') {
                    $hasData = true;
                    break;
                }
            }
            
            if ($hasData) {
                $data = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($mainData['titikUkur']),
                    'NoSeri' => $this->formatNumericValue($mainData['NoSeri']),
                    'STD' => $this->formatNumericValue($mainData['STD']),
                    
                    // C1 Data (Siklus 1)
                    'C1M' => $this->formatNumericValue($request->{"C1M_{$i}"} ?? null),
                    'C1UL' => $this->formatNumericValue($request->{"C1UL_{$i}"} ?? null),
                    'C1LL' => $this->formatNumericValue($request->{"C1LL_{$i}"} ?? null),
                    'C1UR' => $this->formatNumericValue($request->{"C1UR_{$i}"} ?? null),
                    'C1LR' => $this->formatNumericValue($request->{"C1LR_{$i}"} ?? null),
                    'C1C' => $this->formatNumericValue($request->{"C1C_{$i}"} ?? null),
                    
                    // C2 Data (Siklus 2)
                    'C2M' => $this->formatNumericValue($request->{"C2M_{$i}"} ?? null),
                    'C2UL' => $this->formatNumericValue($request->{"C2UL_{$i}"} ?? null),
                    'C2LL' => $this->formatNumericValue($request->{"C2LL_{$i}"} ?? null),
                    'C2UR' => $this->formatNumericValue($request->{"C2UR_{$i}"} ?? null),
                    'C2LR' => $this->formatNumericValue($request->{"C2LR_{$i}"} ?? null),
                    'C2C' => $this->formatNumericValue($request->{"C2C_{$i}"} ?? null),
                ];

                \Log::debug("💾 Saving DetailGaugeBlock row {$i}", [
                    'titikUkur' => $data['titikUkur'],
                    'NoSeri' => $data['NoSeri'],
                    'STD' => $data['STD']
                ]);
                
                DetailGaugeBlock::create($data);
                $detailCount++;
            } else {
                \Log::debug("⏭️ Skipping row {$i} - no main data");
            }
        }

        \Log::info("✅ Saved {$detailCount} DetailGaugeBlock records");

        // ==================================================================
        // 4. SIMPAN ADD GAUGE BLOCK (DATA TAMBAHAN) - 3 RECORD TERPISAH
        // ==================================================================
        \Log::info('📊 Saving AddGaugeBlock data (3 records Uji Kerataan)...');
        $addCount = 0;

        // Simpan 3 record terpisah untuk Uji Kerataan
        for ($i = 1; $i <= 3; $i++) {
            // Ambil data dari form sesuai dengan name attribute
            $titikUkurKerataan = $this->formatNumericValue($request->{"nominal_gauge_{$i}"} ?? null);
            $kiriValue = $request->{"kiri{$i}"} ?? null;
            $kananValue = $request->{"kanan{$i}"} ?? null;
            
            \Log::debug("📝 Processing Uji Kerataan record {$i}:", [
                'titikUkurKerataan' => $titikUkurKerataan,
                'Lsurface' => $kiriValue,
                'Rsurface' => $kananValue,
            ]);
            
            // Cek apakah ada data untuk record ini
            $hasData = $titikUkurKerataan !== null || $kiriValue !== null || $kananValue !== null;
            
            if ($hasData) {
                $addData = [
                    'calibration_id' => $calibration->id,
                    'titikUkurKerataan' => $titikUkurKerataan,
                    'Lsurface' => $kiriValue,
                    'Rsurface' => $kananValue,
                ];
                
                AddGaugeBlock::create($addData);
                $addCount++;
                
                \Log::info("✅ AddGaugeBlock record {$i} saved", $addData);
            } else {
                \Log::debug("⏭️ Skipping Uji Kerataan record {$i} - no data");
            }
        }

        \Log::info("✅ Saved {$addCount} AddGaugeBlock records (Uji Kerataan)");

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN - SEPERTI ALAT LAIN
        // ==================================================================
        $updateData = [];
        
        // Data TTD dan nama
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        // Data uncertainty dan conclusion
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }

        // Data tambahan lainnya
        if ($request->filled('additional_info')) {
            $updateData['additional_info'] = $request->additional_info;
        }

        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('📝 Calibration updated with additional data:', $updateData);
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        \Log::info('📋 STORE SUMMARY (Gauge Block):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $detailCount,
            'add_records' => $addCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'method' => $calibrationMethod,
        ]);

        \Log::info('🎉 storeGaugeBlock COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeGaugeBlock:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana seperti di alat lain
        if (isset($head) && $head->id) {
            try {
                DetailGaugeBlock::where('calibration_id', $calibration->id)->delete();
                AddGaugeBlock::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Gauge Block: " . $e->getMessage());
    }
}

private function updateGaugeBlock($request, $calibration)
{
    try {
        \Log::info('🚀 START updateGaugeBlock');
        
        // ==================================================================
        // 1. UPDATE HEAD GAUGE BLOCK - SEPERTI TORQUE METER
        // ==================================================================
        $textValue  = trim($request->alat_standar_text ?? '');
        $arrayValue = $request->input('alat_standar', []);

        if (!empty($textValue)) {
            $standardValue = $textValue;
        } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
            $standardValue = implode("\n", $arrayValue);
        } else {
            $standardValue = '';
        }

        if ($head = $calibration->headGaugeBlock) {
            $head->update([
                'standard' => $standardValue,
                // Tambahkan update field lain jika ada
                'updated_at' => now(),
            ]);
            \Log::info('✅ HeadGaugeBlock updated:', ['head_id' => $head->id]);
        } else {
            $head = HeadGaugeBlock::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $standardValue,
                'calibrationMethod' => 'PAS-IK1102-09 (JIS B 7506:2003 (JMA/JSA); SNSU PK.P-09:2020)',
            ]);
            \Log::info('➕ HeadGaugeBlock created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL GAUGE BLOCK (DELETE & RECREATE) - SEPERTI TORQUE WRENCH
        // ==================================================================
        // Hapus data detail lama
        $deletedCount = DetailGaugeBlock::where('calibration_id', $calibration->id)->delete();
        \Log::info('🗑️ Old DetailGaugeBlock deleted:', ['count' => $deletedCount]);
        
        $detailCount = 0;
        
        // Proses 15 baris data
        for ($i = 1; $i <= 15; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            $mainData = [
                'titikUkur' => $request->{"titikUkur_{$i}"} ?? null,
                'NoSeri' => $request->{"NoSeri_{$i}"} ?? null,
                'STD' => $request->{"STD_{$i}"} ?? null,
            ];
            
            foreach ($mainData as $value) {
                if ($value !== null && $value !== '') {
                    $hasData = true;
                    break;
                }
            }
            
            if ($hasData) {
                DetailGaugeBlock::create([
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($mainData['titikUkur']),
                    'NoSeri' => $this->formatNumericValue($mainData['NoSeri']),
                    'STD' => $this->formatNumericValue($mainData['STD']),
                    
                    // C1 Data
                    'C1M' => $this->formatNumericValue($request->{"C1M_{$i}"} ?? null),
                    'C1UL' => $this->formatNumericValue($request->{"C1UL_{$i}"} ?? null),
                    'C1LL' => $this->formatNumericValue($request->{"C1LL_{$i}"} ?? null),
                    'C1UR' => $this->formatNumericValue($request->{"C1UR_{$i}"} ?? null),
                    'C1LR' => $this->formatNumericValue($request->{"C1LR_{$i}"} ?? null),
                    'C1C' => $this->formatNumericValue($request->{"C1C_{$i}"} ?? null),
                    
                    // C2 Data
                    'C2M' => $this->formatNumericValue($request->{"C2M_{$i}"} ?? null),
                    'C2UL' => $this->formatNumericValue($request->{"C2UL_{$i}"} ?? null),
                    'C2LL' => $this->formatNumericValue($request->{"C2LL_{$i}"} ?? null),
                    'C2UR' => $this->formatNumericValue($request->{"C2UR_{$i}"} ?? null),
                    'C2LR' => $this->formatNumericValue($request->{"C2LR_{$i}"} ?? null),
                    'C2C' => $this->formatNumericValue($request->{"C2C_{$i}"} ?? null),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ DetailGaugeBlock updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE ADD GAUGE BLOCK - SEPERTI TORQUE WRENCH
        // ==================================================================
        if ($addGaugeBlock = $calibration->addGaugeBlock) {
            $updateData = [
                'titikUkurKerataan' => $this->formatNumericValue($request->titikUkurKerataan ?? $addGaugeBlock->titikUkurKerataan),
                'Lsurface' => $this->formatNumericValue($request->Lsurface ?? $addGaugeBlock->Lsurface),
                'Rsurface' => $this->formatNumericValue($request->Rsurface ?? $addGaugeBlock->Rsurface),
                'note' => $request->note ?? $addGaugeBlock->note,
                'updated_at' => now(),
            ];
            
            $addGaugeBlock->update($updateData);
            \Log::info('✅ AddGaugeBlock updated:', ['add_id' => $addGaugeBlock->id]);
        } else {
            // Buat baru jika belum ada
            $addData = [
                'calibration_id' => $calibration->id,
                'titikUkurKerataan' => $this->formatNumericValue($request->titikUkurKerataan ?? null),
                'Lsurface' => $this->formatNumericValue($request->Lsurface ?? null),
                'Rsurface' => $this->formatNumericValue($request->Rsurface ?? null),
                'note' => $request->note ?? null,
            ];
            
            // Cek apakah ada data untuk disimpan
            $hasAddData = false;
            foreach ($addData as $key => $value) {
                if ($key !== 'calibration_id' && $value !== null && $value !== '') {
                    $hasAddData = true;
                    break;
                }
            }
            
            if ($hasAddData) {
                $addGaugeBlock = AddGaugeBlock::create($addData);
                \Log::info('➕ AddGaugeBlock created baru:', ['add_id' => $addGaugeBlock->id]);
            } else {
                \Log::info('⚠️ No AddGaugeBlock data to create');
            }
        }

        // ==================================================================
        // 4. UPDATE CALIBRATION - SEPERTI ALAT LAIN
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if ($request->filled('additional_info')) {
            $updateData['additional_info'] = $request->additional_info;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('📝 Calibration updated:', $updateData);
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = DetailGaugeBlock::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddGaugeBlock::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Gauge Block):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'standard' => $standardValue,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updateGaugeBlock COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateGaugeBlock:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}


private function storeHoletest($request, $calibration, $certificateId)
{
    try {
        $alatStandarString = 'RING GAUGE 3 ~ 45 mm';
        
        \Log::info('🔧 Alat standar FIXED for Holetest:', [
            'alat_standar' => $alatStandarString,
        ]);

        // Simpan ke Head Holetest
        $head = HeadHoletest::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-49',
        ]);

        \Log::info('✅ Head Holetest saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - SEKARANG 14 BARIS
        \Log::info('📊 Saving detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 14; $i++) { // UBAH DARI 11 MENJADI 14
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada penunjukan yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("penunjukan_{$i}_{$j}") && !empty(trim($request->{"penunjukan_{$i}_{$j}"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data nominal atau penunjukan
            if (($request->has("nominal_$i") && !empty(trim($request->{"nominal_$i"}))) || $hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $request->{"nominal_$i"} ?? '',
                    'rep01' => $request->{"penunjukan_{$i}_1"} ?? null,
                    'rep02' => $request->{"penunjukan_{$i}_2"} ?? null,
                    'rep03' => $request->{"penunjukan_{$i}_3"} ?? null,
                    'rep04' => $request->{"penunjukan_{$i}_4"} ?? null,
                    'rep05' => $request->{"penunjukan_{$i}_5"} ?? null,
                ];

                \Log::info("📝 Saving detail row $i:", $detailData);
                
                DetailHoletest::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing holetest data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

private function storeConductivityMeter($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeConductivityMeter');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - SEDERHANA HANYA CHECKBOX
        // ==================================================================
        $alatStandar = [];
        
        // Cek checkbox TES
        if ($request->has('alat_standar') && in_array('TES', $request->input('alat_standar', []))) {
            $alatStandar[] = 'TES';
        }
        
        // Cek checkbox TFA
        if ($request->has('alat_standar') && in_array('TFA', $request->input('alat_standar', []))) {
            $alatStandar[] = 'TFA';
        }
        
        // Gabungkan alat standar yang dipilih
        $standardValue = '';
        if (!empty($alatStandar)) {
            $standardValue = 'CRM, Thermoscientific. ' . implode(', ', $alatStandar);
        } else {
            $standardValue = 'CRM, Thermoscientific.';
        }

        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $standardValue]);

        // ==================================================================
        // 2. SIMPAN KE HEAD CONDUCTIVITY METER
        // ==================================================================
        $head = HeadConductivityMeter::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-41', // Hardcode sesuai HTML
        ]);

        \Log::info('✅ HeadConductivityMeter saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL CONDUCTIVITY METER (6 BARIS)
        // ==================================================================
        \Log::info('📊 Saving detailConductivityMeter data (6 rows)...');
        $detailCount = 0;

        for ($i = 1; $i <= 6; $i++) {
            // Ambil data nilai CRM dari input
            $nilaiCRM = $request->input("nilai_crm_{$i}") ?? null;
            
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek pembacaan alat 1-5 untuk baris ini
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("pembacaan_{$i}_{$j}") && !empty($request->{"pembacaan_{$i}_{$j}"})) {
                    $hasData = true;
                    break;
                }
            }
            
            // Cek resolusi dan suhu CRM
            if (!$hasData) {
                if ($request->has("resolusi_{$i}") && !empty($request->{"resolusi_{$i}"})) {
                    $hasData = true;
                }
                if ($request->has("suhu_crm_{$i}") && !empty($request->{"suhu_crm_{$i}"})) {
                    $hasData = true;
                }
            }
            
            // Simpan jika ada data
            if (($nilaiCRM !== null && $nilaiCRM !== '') || $hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nilaiCRM' => $this->formatNumericValue($nilaiCRM),
                    'rep01' => $this->formatNumericValue($request->input("pembacaan_{$i}_1") ?? null),
                    'rep02' => $this->formatNumericValue($request->input("pembacaan_{$i}_2") ?? null),
                    'rep03' => $this->formatNumericValue($request->input("pembacaan_{$i}_3") ?? null),
                    'rep04' => $this->formatNumericValue($request->input("pembacaan_{$i}_4") ?? null),
                    'rep05' => $this->formatNumericValue($request->input("pembacaan_{$i}_5") ?? null),
                    'Resolusi' => $this->formatNumericValue($request->input("resolusi_{$i}") ?? null),
                    'suhuCRM' => $this->formatNumericValue($request->input("suhu_crm_{$i}") ?? null),
                ];

                detailConductivityMeter::create($detailData);
                $detailCount++;
                
                    \Log::debug("📝 Saved Conductivity Meter row {$i}", [
                        'nilaiCRM' => $nilaiCRM,
                       
                    ]);
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detailConductivityMeter records");

        // ==================================================================
        // 4. UPDATE CALIBRATION DENGAN DATA TAMBAHAN (TTD dan nama)
        // ==================================================================
        $updateData = [];
        
        // Gunakan hanya nama_dikalibrasi dan nama_diperiksa
        if ($request->filled('calibrated_by')) {
            $updateData['calibratedBy'] = $request->calibrated_by;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->calibrated_by]);
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verifiedBy'] = $request->verified_by;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->verified_by]);
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = detailConductivityMeter::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Conductivity Meter):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $standardValue,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storeConductivityMeter COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeConductivityMeter:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                detailConductivityMeter::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Conductivity Meter: " . $e->getMessage());
    }
}

private function updateConductivityMeter($request, $calibration)
{
    try {
        \Log::info('🚀 START updateConductivityMeter');
        
        // ==================================================================
        // 1. UPDATE HEAD CONDUCTIVITY METER
        // ==================================================================
        $textValue = trim($request->alat_standar_text ?? '');
        $arrayValue = $request->input('alat_standar', []);
        
        if (!empty($textValue)) {
            $standardValue = $textValue;
        } elseif (is_array($arrayValue) && count($arrayValue) > 0) {
            $standardValue = implode("\n", $arrayValue);
        } else {
            $standardValue = '';
        }
        
        if ($head = $calibration->HeadConductivityMeter) {
            $head->update([
                'standard' => $standardValue,
            ]);
            \Log::info('✅ HeadConductivityMeter updated:', ['standard' => $standardValue]);
        } else {
            // Jika head belum ada, buat baru
            $head = HeadConductivityMeter::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? null,
                'standard' => $standardValue,
                'calibrationMethod' => 'PAS-IK1102-41',
            ]);
            \Log::info('➕ HeadConductivityMeter created baru:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL CONDUCTIVITY METER (DELETE & RECREATE)
        // ==================================================================
        // Hapus data detail lama
        detailConductivityMeter::where('calibration_id', $calibration->id)->delete();
        
        $detailCount = 0;
        
        // Proses 6 baris data
        for ($i = 1; $i <= 6; $i++) {
            $nilaiCRM = $request->input("nilai_crm_{$i}") ?? null;
            
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("pembacaan_{$i}_{$j}") && !empty($request->{"pembacaan_{$i}_{$j}"})) {
                    $hasData = true;
                    break;
                }
            }
            
            if ($request->has("resolusi_{$i}") && !empty($request->{"resolusi_{$i}"})) {
                $hasData = true;
            }
            
            if ($request->has("suhu_crm_{$i}") && !empty($request->{"suhu_crm_{$i}"})) {
                $hasData = true;
            }
            
            if (($nilaiCRM !== null && $nilaiCRM !== '') || $hasData) {
                detailConductivityMeter::create([
                    'calibration_id' => $calibration->id,
                    'nilaiCRM' => $this->formatNumericValue($nilaiCRM),
                    'pembacaan1' => $this->formatNumericValue($request->input("pembacaan_{$i}_1") ?? null),
                    'pembacaan2' => $this->formatNumericValue($request->input("pembacaan_{$i}_2") ?? null),
                    'pembacaan3' => $this->formatNumericValue($request->input("pembacaan_{$i}_3") ?? null),
                    'pembacaan4' => $this->formatNumericValue($request->input("pembacaan_{$i}_4") ?? null),
                    'pembacaan5' => $this->formatNumericValue($request->input("pembacaan_{$i}_5") ?? null),
                    'resolusi' => $this->formatNumericValue($request->input("resolusi_{$i}") ?? null),
                    'suhuCRM' => $this->formatNumericValue($request->input("suhu_crm_{$i}") ?? null),
                ]);
                $detailCount++;
            }
        }
        
        \Log::info('✅ detailConductivityMeter updated:', ['total_records' => $detailCount]);

        // ==================================================================
        // 3. UPDATE CALIBRATION
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('nama_dikalibrasi')) {
            $updateData['calibrated_by'] = $request->nama_dikalibrasi;
        }
        
        if ($request->filled('nama_diperiksa')) {
            $updateData['verified_by'] = $request->nama_diperiksa;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 4. LOG HASIL AKHIR
        // ==================================================================
        $finalDetailCount = detailConductivityMeter::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 UPDATE SUMMARY (Conductivity Meter):', [
            'calibration_id' => $calibration->id,
            'detail_records' => $finalDetailCount,
            'standard' => $standardValue,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 updateConductivityMeter COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR updateConductivityMeter:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
        ]);
        throw $e;
    }
}

private function storeCoatingThickness($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeCoatingThickness');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR: SELALU ADA 2 ITEM DIPISAH KOMA
        // ==================================================================

               // Item pertama: selalu Coating Film Standar
        $alatStandar = ['Coating Film Standar'];

        // Proses No Seri
        $noSeriValue = '';

        if ($request->has('no_seri_pilihan')) {
            $selectedOption = $request->input('no_seri_pilihan');
            
            if ($selectedOption == '1') {
                $noSeriInput = $request->input('no_seri_1', '');
                $noSeriValue = $noSeriInput ? trim($noSeriInput) : '';
            } elseif ($selectedOption == '2') {
                $noSeriValue = 'T99022255-1';
            }
        }

        // Fallback jika tidak ada pilihan atau kosong
        if (empty($noSeriValue)) {
            $noSeriValue = 'T99022255-1';
        }

        \Log::info('🔢 No Seri selected:', ['value' => $noSeriValue]);

        // Tambahkan dengan label "No. Seri"
        $alatStandar[] = 'No. Seri ' . $noSeriValue;

        // Gabungkan dengan koma
        $finalStandard = implode(', ', $alatStandar);

        \Log::info('🔧 Final standard value (saved to DB):', ['standard' => $finalStandard]);

        // ==================================================================
        // 3. SIMPAN KE HEAD COATING THICKNESS
        // ==================================================================
        $head = HeadCoatingThickness::create([
            'calibration_id'     => $calibration->id,
            'certificate_id'     => $certificateId,
            'standard'           => $finalStandard,          // ← "Coating Film Standar, ABC123" atau "Coating Film Standar, T99022255-1"
            'calibrationMethod'  => 'PAS-IK1102-46',
        ]);

        \Log::info('✅ HeadCoatingThickness saved:', [
            'head_id'  => $head->id,
            'standard' => $head->standard
        ]);

        // ==================================================================
        // 4. SIMPAN DETAIL COATING THICKNESS
        // ==================================================================
        \Log::info('📊 Saving detailCoatingThickness data...');
        $detailCount = 0;

        $jumlah_baris = 12;
        
        for ($row = 1; $row <= $jumlah_baris; $row++) {
            $titikUkur = $request->input("nominal_{$row}") ?? null;
            
            $hasData = false;
            
            if ($titikUkur !== null && $titikUkur !== '') {
                $hasData = true;
            } else {
                for ($col = 1; $col <= 5; $col++) {
                    if ($request->has("pembacaan_{$row}_{$col}") && !empty($request->{"pembacaan_{$row}_{$col}"})) {
                        $hasData = true;
                        break;
                    }
                }
                
                if (!$hasData && $request->has("resolusi_{$row}") && !empty($request->{"resolusi_{$row}"})) {
                    $hasData = true;
                }
            }
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur'      => $this->formatNumericValue($titikUkur),
                    'rep01'          => $this->formatNumericValue($request->input("pembacaan_{$row}_1") ?? null),
                    'rep02'          => $this->formatNumericValue($request->input("pembacaan_{$row}_2") ?? null),
                    'rep03'          => $this->formatNumericValue($request->input("pembacaan_{$row}_3") ?? null),
                    'rep04'          => $this->formatNumericValue($request->input("pembacaan_{$row}_4") ?? null),
                    'rep05'          => $this->formatNumericValue($request->input("pembacaan_{$row}_5") ?? null),
                    'resolusi'       => $this->formatNumericValue($request->input("resolusi_{$row}") ?? null),
                ];

                DetailCoatingThickness::create($detailData);
                $detailCount++;
                
                \Log::debug("📝 Saved Coating Thickness row {$row}", [
                    'titikUkur'   => $titikUkur,
                    'pembacaan_1' => $request->input("pembacaan_{$row}_1"),
                    'pembacaan_2' => $request->input("pembacaan_{$row}_2"),
                    'resolusi'    => $request->input("resolusi_{$row}"),
                ]);
            }
        }
        
        \Log::info("✅ Saved {$detailCount} detailCoatingThickness records");

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        \Log::info('🔍 Checking form inputs for calibration:', [
            'calibrated_by' => $request->input('calibrated_by'),
            'verified_by'   => $request->input('verified_by')
        ]);
        
        if ($request->filled('calibrated_by')) {
            $updateData['calibratedBy'] = $request->calibrated_by;
        } else {
            $updateData['calibratedBy'] = '-';
            \Log::warning('⚠️ calibrated_by kosong, set calibratedBy = "-"');
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verifiedBy'] = $request->verified_by;
        } else {
            $updateData['verifiedBy'] = '-';
            \Log::warning('⚠️ verified_by kosong, set verifiedBy = "-"');
        }
        
        if ($request->filled('nama_kalibrator')) {
            $updateData['calibrator_name'] = $request->nama_kalibrator;
        }
        
        if ($request->filled('nama_pemeriksa')) {
            $updateData['verifier_name'] = $request->nama_pemeriksa;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
        }
        
        if ($request->filled('conclusion')) {
            $updateData['keterangan'] = $request->conclusion;
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated:', $updateData);
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailCoatingThickness::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Coating Thickness):', [
            'calibration_id' => $calibration->id,
            'head_id'        => $head->id,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'standard'       => $finalStandard,
            'calibratedBy'   => $calibration->calibratedBy ?? null,
            'verifiedBy'     => $calibration->verifiedBy ?? null,
        ]);

        \Log::info('🎉 storeCoatingThickness COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeCoatingThickness:', [
            'message'        => $e->getMessage(),
            'file'           => $e->getFile(),
            'line'           => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace'          => $e->getTraceAsString()
        ]);
        
        if (isset($head) && $head->id) {
            try {
                DetailCoatingThickness::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Coating Thickness: " . $e->getMessage());
    }
}

private function storeDurometer($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeDurometer');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR DARI CHECKBOX
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Durometer:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD DUROMETER
        // ==================================================================
        $head = HeadDurometer::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-56',
        ]);

        \Log::info('✅ HeadDurometer saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL DUROMETER (5 TITIK UKUR)
        // ==================================================================
        \Log::info('📊 Saving DetailDurometer data (5 titik ukur)...');
        $detailCount = 0;
        
        // Proses 5 titik ukur (sesuai form HTML)
        for ($i = 1; $i <= 10; $i++) {
            // Ambil titik ukur dari input - HANYA ambil dari input
            $titikUkur = $request->input("titikUkur_{$i}") ?? null;
            
            // Ambil data pembacaan
            $x1 = $request->input("x1_{$i}") ?? null;
            $x2 = $request->input("x2_{$i}") ?? null;
            $x3 = $request->input("x3_{$i}") ?? null;
            
            // Cek apakah ada data untuk titik ukur ini
            $hasData = !empty($titikUkur) || !empty($x1) || !empty($x2) || !empty($x3);
            
            // HANYA simpan jika ada data (tidak pakai nilai default)
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($titikUkur),
                    'x1' => $this->formatNumericValue($x1),
                    'x2' => $this->formatNumericValue($x2),
                    'x3' => $this->formatNumericValue($x3),
                ];

                // Debug sebelum save
                \Log::debug("💾 Saving DetailDurometer row {$i}:", [
                    'titikUkur' => $detailData['titikUkur'],
                    'x1' => $detailData['x1'],
                    'x2' => $detailData['x2'],
                    'x3' => $detailData['x3'],
                    'input_names' => "titikUkur_{$i}, x1_{$i}, x2_{$i}, x3_{$i}"
                ]);
                
                // Simpan data
                DetailDurometer::create($detailData);
                $detailCount++;
                
                \Log::debug("✅ Saved Durometer row {$i}");
            } else {
                \Log::debug("⏭️ Skipping row {$i} - no data found");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailDurometer records");

        // ==================================================================
        // 4. SIMPAN ADD DUROMETER (DATA REPEATABILITY)
        // ==================================================================
        \Log::info('📊 Saving AddDurometer data (repeatability)...');
        
        $addData = [
            'calibration_id' => $calibration->id,
            
            // Ulangan 1-10 - ambil dari input dengan nama yang sesuai
            'rep01' => $this->formatNumericValue($request->input('repeatability_1_1') ?? null),
            'rep02' => $this->formatNumericValue($request->input('repeatability_1_2') ?? null),
            'rep03' => $this->formatNumericValue($request->input('repeatability_1_3') ?? null),
            'rep04' => $this->formatNumericValue($request->input('repeatability_1_4') ?? null),
            'rep05' => $this->formatNumericValue($request->input('repeatability_1_5') ?? null),
            'rep06' => $this->formatNumericValue($request->input('repeatability_2_1') ?? null),
            'rep07' => $this->formatNumericValue($request->input('repeatability_2_2') ?? null),
            'rep08' => $this->formatNumericValue($request->input('repeatability_2_3') ?? null),
            'rep09' => $this->formatNumericValue($request->input('repeatability_2_4') ?? null),
            'rep10' => $this->formatNumericValue($request->input('repeatability_2_5') ?? null),
        ];
        
        // Cek apakah ada data untuk disimpan
        $hasAddData = false;
        foreach ($addData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null) {
                $hasAddData = true;
                break;
            }
        }
        
        if ($hasAddData) {
            $addRecord = AddDurometer::create($addData);
            \Log::info('✅ AddDurometer saved:', ['add_id' => $addRecord->id]);
        } else {
            \Log::info('⚠️ No AddDurometer data to save');
        }

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TTD DAN NAMA
        // ==================================================================
        $updateData = [];
        
        // Ambil nama dari input calibrated_by dan verified_by
        if ($request->filled('calibrated_by')) {
            $updateData['calibrated_by'] = $request->calibrated_by;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->calibrated_by]);
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->verified_by]);
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailDurometer::where('calibration_id', $calibration->id)->count();
        $savedAddCount = AddDurometer::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Durometer):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'add_records' => $savedAddCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
        ]);

        \Log::info('🎉 storeDurometer COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeDurometer:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailDurometer::where('calibration_id', $calibration->id)->delete();
                AddDurometer::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Durometer: " . $e->getMessage());
    }
}

private function storeMikropipetDispenset($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeMikropipetDispenset');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Mikropipet/Dispenset:', ['alat_standar' => $alatStandar]);

        // ==================================================================
        // 2. SIMPAN KE HEAD MIKROPIPET DISPENSET
        // ==================================================================
        $head = HeadMikropipetDispenset::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-39 (Volumetrik Piston)',
        ]);

        \Log::info('✅ HeadMikropipetDispenset saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL MIKROPIPET DISPENSET (4 REKAMAN)
        // ==================================================================
        \Log::info('📊 Saving DetailMikropipetDispenset data...');
        
        // Simpan 4 record berdasarkan posisi dan bagian
        $savedCount = 0;
        
        // KIRI ATAS
        if ($this->saveMikropipetRecord($request, $calibration->id, 'kiri', 'atas')) {
            $savedCount++;
        }
        
        // KANAN ATAS
        if ($this->saveMikropipetRecord($request, $calibration->id, 'kanan', 'atas')) {
            $savedCount++;
        }
        
        // KIRI BAWAH
        if ($this->saveMikropipetRecord($request, $calibration->id, 'kiri', 'bawah')) {
            $savedCount++;
        }
        
        // KANAN BAWAH
        if ($this->saveMikropipetRecord($request, $calibration->id, 'kanan', 'bawah')) {
            $savedCount++;
        }
        
        \Log::info("✅ Saved {$savedCount} DetailMikropipetDispenset records");

        // ==================================================================
        // 4. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        // Data TTD dan nama dari calibration
        if ($request->filled('calibrated_by')) {
            $updateData['calibrated_by'] = $request->calibrated_by;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->calibrated_by]);
        }
        
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->verified_by]);
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $totalDetailRecords = DetailMikropipetDispenset::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Mikropipet/Dispenset):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $totalDetailRecords,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storeMikropipetDispenset COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeMikropipetDispenset:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailMikropipetDispenset::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Mikropipet/Dispenset: " . $e->getMessage());
    }
}

/**
 * Helper method untuk menyimpan satu record DetailMikropipetDispenset
 */
private function saveMikropipetRecord($request, $calibrationId, $posisi, $bagian)
{
    // Tentukan prefix berdasarkan posisi dan bagian
    $prefix = ($bagian === 'atas') ? '' : '_bawah';
    $posisiPrefix = ($posisi === 'kiri') ? 'kiri' : 'kanan';
    
    // Ambil nilai titik ukur (nominal) - coba dari header atau baris
    $titikUkur = $request->input("nominal_{$posisiPrefix}{$prefix}") 
                ?? $request->input("nominal_{$posisiPrefix}{$prefix}_1") 
                ?? null;
    
    // Check if any data exists for this position
    $hasData = false;
    
    // Check m0-m11 values
    for ($i = 0; $i <= 11; $i++) {
        $inputName = ($bagian === 'atas') 
            ? "m{$i}_{$posisiPrefix}" 
            : "m{$i}_{$posisiPrefix}_{$bagian}";
        
        if ($request->has($inputName) && $request->input($inputName) !== null) {
            $hasData = true;
            break;
        }
    }
    
    // Check parameter pendukung
    if (!$hasData) {
        $paramInputs = [
            "suhu_awal_{$posisiPrefix}{$prefix}",
            "suhu_akhir_{$posisiPrefix}{$prefix}",
            "kelembaban_awal_{$posisiPrefix}{$prefix}",
            "kelembaban_akhir_{$posisiPrefix}{$prefix}",
            "tekanan_awal_{$posisiPrefix}{$prefix}",
            "tekanan_akhir_{$posisiPrefix}{$prefix}",
            "suhu_air_awal_{$posisiPrefix}{$prefix}",
            "suhu_air_akhir_{$posisiPrefix}{$prefix}",
            "waktu_{$posisiPrefix}{$prefix}"
        ];
        
        foreach ($paramInputs as $param) {
            if ($request->has($param) && $request->input($param) !== null) {
                $hasData = true;
                break;
            }
        }
    }
    
    if (!$hasData && empty($titikUkur)) {
        \Log::debug("⏭️ Skipping {$posisi}-{$bagian} - no data");
        return false;
    }
    
    // Persiapkan data untuk DetailMikropipetDispenset
    $detailData = [
        'calibration_id' => $calibrationId,
        'titikUkur' => $this->formatNumericValue($titikUkur),
    ];
    
    // Tambahkan nilai m0 sampai m11
    for ($i = 0; $i <= 11; $i++) {
        $inputName = ($bagian === 'atas') 
            ? "m{$i}_{$posisiPrefix}" 
            : "m{$i}_{$posisiPrefix}_{$bagian}";
        
        $detailData["m{$i}"] = $this->formatNumericValue($request->input($inputName));
    }
    
    // Tambahkan parameter pendukung dengan mapping ke field database
    $detailData['TUdaraS'] = $this->formatNumericValue($request->input("suhu_awal_{$posisiPrefix}{$prefix}"));
    $detailData['TUdaraE'] = $this->formatNumericValue($request->input("suhu_akhir_{$posisiPrefix}{$prefix}"));
    $detailData['RHS'] = $this->formatNumericValue($request->input("kelembaban_awal_{$posisiPrefix}{$prefix}"));
    $detailData['RHE'] = $this->formatNumericValue($request->input("kelembaban_akhir_{$posisiPrefix}{$prefix}"));
    $detailData['PUdaraS'] = $this->formatNumericValue($request->input("tekanan_awal_{$posisiPrefix}{$prefix}"));
    $detailData['PUdaraE'] = $this->formatNumericValue($request->input("tekanan_akhir_{$posisiPrefix}{$prefix}"));
    $detailData['TAirS'] = $this->formatNumericValue($request->input("suhu_air_awal_{$posisiPrefix}{$prefix}"));
    $detailData['TAirE'] = $this->formatNumericValue($request->input("suhu_air_akhir_{$posisiPrefix}{$prefix}"));
    $detailData['waktu'] = $this->formatNumericValue($request->input("waktu_{$posisiPrefix}{$prefix}"));
    
    \Log::debug("💾 Saving DetailMikropipetDispenset [{$posisi}-{$bagian}]:", [
        'titikUkur' => $detailData['titikUkur'],
        'calibration_id' => $calibrationId,
        'm_count' => count(array_filter($detailData, function($key) {
            return str_starts_with($key, 'm');
        }, ARRAY_FILTER_USE_KEY))
    ]);
    
    DetailMikropipetDispenset::create($detailData);
    return true;
}



private function storeTaperGauge($request, $calibration, $certificateId)
{
    try {
        $alatStandarString = 'GAUGE BLOCK SET GRADE 0 (1160776)';
        
        \Log::info('🔧 Alat standar FIXED for Holetest:', [
            'alat_standar' => $alatStandarString,
        ]);
        
      

        // Simpan ke Head Taper Gauge
        $head = HeadTaperGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-57',
        ]);

        \Log::info('✅ Head Taper Gauge saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - SEKARANG 14 BARIS
        \Log::info('📊 Saving detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 15; $i++) { // UBAH DARI 11 MENJADI 14
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada penunjukan yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("penunjukan_{$i}_{$j}") && !empty(trim($request->{"penunjukan_{$i}_{$j}"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data nominal atau penunjukan
            if (($request->has("nominal_$i") && !empty(trim($request->{"nominal_$i"}))) || $hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $request->{"nominal_$i"} ?? '',
                    'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                    'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                    'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                    'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                    'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                ];

                \Log::info("📝 Saving detail row $i:", $detailData);
                
                DetailTaperGauge::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Taper Gauge data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}


private function storeFeelerGauge($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeFeelerGauge');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - DIHARDCODE (TIDAK AMBIL DARI INPUTAN)
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar FIXED for Feeler Gauge:', [
            'alat_standar' => $alatStandarString,
           
        ]);

        // ==================================================================
        // 2. SIMPAN KE HEAD FEELER GAUGE
        // ==================================================================
        $head = HeadFeelerGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-62',
        ]);

        \Log::info('✅ HeadFeelerGauge saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 3. SIMPAN DETAIL FEELER GAUGE (25 BARIS - SESUAI FORM)
        // ==================================================================
        \Log::info('📊 Saving DetailFeelerGauge data (25 rows)...');
        $detailCount = 0;
        
        // Proses 25 baris data (sesuai form)
        for ($i = 1; $i <= 25; $i++) {
            // Ambil data dari form sesuai nama input
            $nominalUUT = $request->{"nominal_uut_$i"} ?? null;
            $nominalGB = $request->{"nominal_gb_$i"} ?? null;
            
            // Data untuk Pengukuran A dan B
            $ab_gb_a = $request->{"ab_gb_a_$i"} ?? null;     // Gauge Block (A) pertama
            $ab_uut_b = $request->{"ab_uut_b_$i"} ?? null;   // UUT (B) pertama
            $ab_gb_a2 = $request->{"ab_gb_a2_$i"} ?? null;   // Gauge Block (A) kedua
            $ab_uut_b2 = $request->{"ab_uut_b2_$i"} ?? null; // UUT (B) kedua
            
            // Data untuk Pengukuran A dan C
            $ac_gb_a = $request->{"ac_gb_a_$i"} ?? null;     // Gauge Block (A) pertama
            $ac_uut_c = $request->{"ac_uut_c_$i"} ?? null;   // UUT (C) pertama
            $ac_gb_a2 = $request->{"ac_gb_a2_$i"} ?? null;   // Gauge Block (A) kedua
            $ac_uut_c2 = $request->{"ac_uut_c2_$i"} ?? null; // UUT (C) kedua
            
            \Log::debug("🔍 Row {$i} data from request:", [
                'nominal_uut' => $nominalUUT,
                'nominal_gb' => $nominalGB,
                'ab_gb_a' => $ab_gb_a,
                'ab_uut_b' => $ab_uut_b,
                'ab_gb_a2' => $ab_gb_a2,
                'ab_uut_b2' => $ab_uut_b2,
                'ac_gb_a' => $ac_gb_a,
                'ac_uut_c' => $ac_uut_c,
                'ac_gb_a2' => $ac_gb_a2,
                'ac_uut_c2' => $ac_uut_c2,
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($nominalUUT) || !empty($nominalGB) || 
                      !empty($ab_gb_a) || !empty($ab_uut_b) ||
                      !empty($ab_gb_a2) || !empty($ab_uut_b2) ||
                      !empty($ac_gb_a) || !empty($ac_uut_c) ||
                      !empty($ac_gb_a2) || !empty($ac_uut_c2);
            
            if ($hasData) {
                // Mapping dari input form ke field database
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nominalUUT' => $this->formatNumericValue($nominalUUT),
                    'nominalGB' => $this->formatNumericValue($nominalGB),
                    
                    // Mapping untuk Pengukuran A dan B
                    'GBA1' => $this->formatNumericValue($ab_gb_a),   // Gauge Block (A) pertama
                    'UUTB1' => $this->formatNumericValue($ab_uut_b), // UUT (B) pertama
                    'GBA2' => $this->formatNumericValue($ab_gb_a2),  // Gauge Block (A) kedua
                    'UUTB2' => $this->formatNumericValue($ab_uut_b2), // UUT (B) kedua
                    
                    // Mapping untuk Pengukuran A dan C
                    // CATATAN: Model Anda hanya punya UUTC3 dan UUTC4, bukan GBA3/GBA4
                    // Sesuaikan dengan field yang ada di model
                    'GBA3' => $this->formatNumericValue($ac_gb_a),   // Gauge Block (A) pertama untuk C
                    'UUTC3' => $this->formatNumericValue($ac_uut_c), // UUT (C) pertama
                    'GBA4' => $this->formatNumericValue($ac_gb_a2),  // Gauge Block (A) kedua untuk C
                    'UUTC4' => $this->formatNumericValue($ac_uut_c2), // UUT (C) kedua
                ];
                
                \Log::debug("💾 Saving DetailFeelerGauge row {$i}:", $detailData);
                
                DetailFeelerGauge::create($detailData);
                $detailCount++;
            } else {
                \Log::debug("⏭️ Skipping row {$i} - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailFeelerGauge records");

        // ==================================================================
        // 4. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        // Nama untuk TTD Dikalibrasi
        if ($request->filled('calibrated_by')) {
            $updateData['calibrated_by'] = $request->calibrated_by;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $request->calibrated_by]);
        }
        
        // Nama untuk TTD Diperiksa
        if ($request->filled('verified_by')) {
            $updateData['verified_by'] = $request->verified_by;
            \Log::info('📝 Nama diperiksa:', ['nama' => $request->verified_by]);
        }
        
        // TTD Dikalibrasi (simpan jika ada field)
        if ($request->filled('ttd_dikalibrasi')) {
            // Simpan ke field yang sesuai, misalnya di tabel users atau calibration
            \Log::info('✍️ TTD dikalibrasi:', ['ttd' => $request->ttd_dikalibrasi]);
        }
        
        // TTD Diperiksa (simpan jika ada field)
        if ($request->filled('ttd_diperiksa')) {
            // Simpan ke field yang sesuai
            \Log::info('✍️ TTD diperiksa:', ['ttd' => $request->ttd_diperiksa]);
        }
        
        // Data uncertainty dan conclusion
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 5. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailFeelerGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Feeler Gauge):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandarString,
    
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storeFeelerGauge COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeFeelerGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailFeelerGauge::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Feeler Gauge: " . $e->getMessage());
    }
}

private function storePHMeter($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storePHMeter');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - KOMBINASI HIDDEN INPUT + CHECKBOX
        // ==================================================================
        
        // Sumber 1: Hidden input (nilai default - HARUS SELALU ADA)
        $hiddenAlatStandar = trim($request->alat_standar_text ?? '');
        \Log::info('🔧 Hidden alat standar:', ['hidden_value' => $hiddenAlatStandar]);
        
        // Sumber 2: Checkbox array (pilihan tambahan user)
        $checkboxAlatStandar = $request->input('alat_standar', []);
        \Log::info('🔧 Checkbox alat standar:', ['checkbox_values' => $checkboxAlatStandar]);
        
        // KOMBINASI KEDUA DATA:
        // 1. Hidden input selalu dimasukkan
        // 2. Jika ada checkbox, tambahkan setelah hidden input
        
        $standardParts = [];
        
        // Tambahkan hidden input terlebih dahulu
        if (!empty($hiddenAlatStandar)) {
            $standardParts[] = $hiddenAlatStandar;
        } else {
            // Fallback jika hidden input kosong
            $standardParts[] = 'CRM Buffer pH, Merck, 4, 7, & 10';
        }
        
        // Tambahkan checkbox jika ada
        if (is_array($checkboxAlatStandar) && count($checkboxAlatStandar) > 0) {
            $checkboxValues = implode(", ", $checkboxAlatStandar);
            $standardParts[] = $checkboxValues;
        }
        
        // Gabungkan kedua bagian
        $standardValue = implode("; ", $standardParts);
        $source = 'combined';
        
        \Log::info('🔧 Alat standar kombinasi:', [
            'hidden' => $hiddenAlatStandar,
            'checkbox' => $checkboxAlatStandar,
            'combined_result' => $standardValue
        ]);

        // ==================================================================
        // 2. PROSES NAMA KALIBRATOR DAN PEMERIKSA
        // ==================================================================
        // PERHATIAN: Perhatikan name input di HTML
        $namaKalibrator = trim($request->calibrated_by ?? ''); // Sesuai name="calibrated_by"
        $namaPemeriksa = trim($request->verified_by ?? '');    // Sesuai name="verified_by"
        
        \Log::info('👤 Nama Kalibrator:', ['nama' => $namaKalibrator]);
        \Log::info('👤 Nama Pemeriksa:', ['nama' => $namaPemeriksa]);

        // ==================================================================
        // 3. SIMPAN KE HEAD PH METER
        // ==================================================================
        $head = HeadPhMeter::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-40',
        ]);

        \Log::info('✅ HeadPhMeter saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 4. SIMPAN DETAIL PH METER (5 TITIK UKUR)
        // ==================================================================
        \Log::info('📊 Saving DetailPhMeter data (5 titik ukur)...');
        $detailCount = 0;
        
        // Proses 5 titik ukur (sesuai form HTML)
        for ($i = 1; $i <= 5; $i++) {
            // Ambil data dari input form sesuai nama input HTML
            $buffer = $request->{"buffer_$i"} ?? null;
            $pembacaan_1 = $request->{"pembacaan_{$i}_1"} ?? null;
            $pembacaan_2 = $request->{"pembacaan_{$i}_2"} ?? null;
            $pembacaan_3 = $request->{"pembacaan_{$i}_3"} ?? null;
            $pembacaan_4 = $request->{"pembacaan_{$i}_4"} ?? null;
            $pembacaan_5 = $request->{"pembacaan_{$i}_5"} ?? null;
            $resolusi = $request->{"resolusi_$i"} ?? null;
            $suhu = $request->{"suhu_$i"} ?? null;
            
            \Log::debug("🔍 Row {$i} data from request:", [
                'buffer' => $buffer,
                'pembacaan_1' => $pembacaan_1,
                'pembacaan_2' => $pembacaan_2,
                'pembacaan_3' => $pembacaan_3,
                'pembacaan_4' => $pembacaan_4,
                'pembacaan_5' => $pembacaan_5,
                'resolusi' => $resolusi,
                'suhu' => $suhu,
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($buffer) || 
                      !empty($pembacaan_1) || !empty($pembacaan_2) || !empty($pembacaan_3) || 
                      !empty($pembacaan_4) || !empty($pembacaan_5) || 
                      !empty($resolusi) || !empty($suhu);
            
            if ($hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nilaiBuffer' => $this->formatNumericValue($buffer),       // buffer_X
                    'rep01' => $this->formatNumericValue($pembacaan_1),       // pembacaan_X_1
                    'rep02' => $this->formatNumericValue($pembacaan_2),       // pembacaan_X_2
                    'rep03' => $this->formatNumericValue($pembacaan_3),       // pembacaan_X_3
                    'rep04' => $this->formatNumericValue($pembacaan_4),       // pembacaan_X_4
                    'rep05' => $this->formatNumericValue($pembacaan_5),       // pembacaan_X_5
                    'Resolusi' => $this->formatNumericValue($resolusi),       // resolusi_X
                    'TBuffer' => $this->formatNumericValue($suhu),            // suhu_X
                ];
                
                \Log::debug("💾 Saving DetailPhMeter row {$i}:", $detailData);
                
                DetailPhMeter::create($detailData);
                $detailCount++;
                
                \Log::debug("✅ Saved pH Meter row {$i}");
            } else {
                \Log::debug("⏭️ Skipping row {$i} - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailPhMeter records");

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        // Update nama kalibrator (jika diisi) - SESUAI NAME INPUT
        if (!empty($namaKalibrator)) {
            $updateData['calibrated_by'] = $namaKalibrator;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $namaKalibrator]);
        }
        
        // Update nama pemeriksa (jika diisi) - SESUAI NAME INPUT
        if (!empty($namaPemeriksa)) {
            $updateData['verified_by'] = $namaPemeriksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $namaPemeriksa]);
        }
        
        // Update uncertainty dan keterangan (jika ada)
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailPhMeter::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (pH Meter):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $standardValue,
            'alat_standar_source' => $source,
            'hidden_alat_standar' => $hiddenAlatStandar,
            'checkbox_alat_standar' => $checkboxAlatStandar,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
        ]);

        \Log::info('🎉 storePHMeter COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storePHMeter:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailPhMeter::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data pH Meter: " . $e->getMessage());
    }
}

private function storeTachometer($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeTachometer');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - HANYA DARI CHECKBOX INPUTAN
        // ==================================================================
        
        // Ambil checkbox array (pilihan user)
        $checkboxAlatStandar = $request->input('alat_standar', []);
        \Log::info('🔧 Checkbox alat standar:', ['checkbox_values' => $checkboxAlatStandar]);
        
        // HANYA gunakan checkbox yang dipilih, TANPA hidden input
        if (is_array($checkboxAlatStandar) && count($checkboxAlatStandar) > 0) {
            $standardValue = implode(", ", $checkboxAlatStandar);
            \Log::info('🔧 Menggunakan alat standar dari checkbox user:', ['alat_standar' => $standardValue]);
        } else {
            $standardValue = ''; // Kosong jika tidak ada checkbox yang dipilih
            \Log::info('🔧 Tidak ada alat standar yang dipilih');
        }

        // ==================================================================
        // 2. PROSES NAMA KALIBRATOR DAN PEMERIKSA
        // ==================================================================
        $namaKalibrator = trim($request->calibrated_by ?? '');
        $namaPemeriksa = trim($request->verified_by ?? '');
        
        \Log::info('👤 Nama Kalibrator:', ['nama' => $namaKalibrator]);
        \Log::info('👤 Nama Pemeriksa:', ['nama' => $namaPemeriksa]);

        // ==================================================================
        // 3. SIMPAN KE HEAD TACHOMETER
        // ==================================================================
        $head = HeadTachometer::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-48', // Sesuai form: PAS-IK1102-48
        ]);

        \Log::info('✅ HeadTachometer saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 4. SIMPAN DETAIL TACHOMETER (BERDASARKAN $jumlah_baris)
        // ==================================================================
        \Log::info('📊 Saving DetailTachometer data...');
        $detailCount = 0;
        
        // Tentukan jumlah baris (dari form atau default)
        $jumlahBaris = $request->jumlah_baris ?? 12; // Default 5 baris jika tidak ada
        
        \Log::info('📝 Jumlah baris tachometer:', ['jumlah_baris' => $jumlahBaris]);
        
        // Proses setiap baris
        for ($row = 1; $row <= $jumlahBaris; $row++) {
            // Ambil data dari input form sesuai nama input HTML
            $nominal = $request->{"nominal_$row"} ?? null;
            $pembacaan_1 = $request->{"pembacaan_{$row}_1"} ?? null;
            $pembacaan_2 = $request->{"pembacaan_{$row}_2"} ?? null;
            $pembacaan_3 = $request->{"pembacaan_{$row}_3"} ?? null;
            $pembacaan_4 = $request->{"pembacaan_{$row}_4"} ?? null;
            $pembacaan_5 = $request->{"pembacaan_{$row}_5"} ?? null;
            $resolusi = $request->{"resolusi_$row"} ?? null;
            
            \Log::debug("🔍 Row {$row} data from request:", [
                'nominal' => $nominal,
                'pembacaan_1' => $pembacaan_1,
                'pembacaan_2' => $pembacaan_2,
                'pembacaan_3' => $pembacaan_3,
                'pembacaan_4' => $pembacaan_4,
                'pembacaan_5' => $pembacaan_5,
                'resolusi' => $resolusi,
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($nominal) || 
                      !empty($pembacaan_1) || !empty($pembacaan_2) || !empty($pembacaan_3) || 
                      !empty($pembacaan_4) || !empty($pembacaan_5) || 
                      !empty($resolusi);
            
            if ($hasData) {
                // MAPPING KE MODEL DetailTachometer
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nilaiStandard' => $this->formatNumericValue($nominal),     // nominal_X
                    'rep01' => $this->formatNumericValue($pembacaan_1),        // pembacaan_X_1
                    'rep02' => $this->formatNumericValue($pembacaan_2),        // pembacaan_X_2
                    'rep03' => $this->formatNumericValue($pembacaan_3),        // pembacaan_X_3
                    'rep04' => $this->formatNumericValue($pembacaan_4),        // pembacaan_X_4
                    'rep05' => $this->formatNumericValue($pembacaan_5),        // pembacaan_X_5
                    'resolusiAlat' => $this->formatNumericValue($resolusi),    // resolusi_X
                ];
                
                \Log::debug("💾 Saving DetailTachometer row {$row}:", $detailData);
                
                DetailTachometer::create($detailData);
                $detailCount++;
                
                \Log::debug("✅ Saved Tachometer row {$row}");
            } else {
                \Log::debug("⏭️ Skipping row {$row} - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailTachometer records");

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        // Update nama kalibrator (jika diisi)
        if (!empty($namaKalibrator)) {
            $updateData['calibrated_by'] = $namaKalibrator;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $namaKalibrator]);
        }
        
        // Update nama pemeriksa (jika diisi)
        if (!empty($namaPemeriksa)) {
            $updateData['verified_by'] = $namaPemeriksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $namaPemeriksa]);
        }
        
        // Update uncertainty dan keterangan (jika ada)
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Update satuan jika ada (sesuai input "Unit (......)")
        if ($request->filled('unit_tachometer')) {
            $updateData['unit'] = $request->unit_tachometer;
            \Log::info('📏 Satuan tachometer:', ['unit' => $request->unit_tachometer]);
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailTachometer::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Tachometer):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'total_rows' => $jumlahBaris,
            'certificate_id' => $certificateId,
            'alat_standar' => $standardValue,
            'alat_standar_checkbox' => $checkboxAlatStandar,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
            'unit' => $calibration->unit ?? null,
        ]);

        \Log::info('🎉 storeTachometer COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeTachometer:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailTachometer::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Tachometer: " . $e->getMessage());
    }
}

private function storePinGauge($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storePinGauge');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR - HANYA DARI CHECKBOX INPUTAN
        // ==================================================================
        
        // Ambil checkbox array (pilihan user)
        $checkboxAlatStandar = $request->input('alat_standar', []);
        \Log::info('🔧 Checkbox alat standar:', ['checkbox_values' => $checkboxAlatStandar]);
        
        // HANYA gunakan checkbox yang dipilih, TANPA hidden input
        if (is_array($checkboxAlatStandar) && count($checkboxAlatStandar) > 0) {
            $standardValue = implode(", ", $checkboxAlatStandar);
            \Log::info('🔧 Menggunakan alat standar dari checkbox user:', ['alat_standar' => $standardValue]);
        } else {
            $standardValue = ''; // Kosong jika tidak ada checkbox yang dipilih
            \Log::info('🔧 Tidak ada alat standar yang dipilih');
        }

        // ==================================================================
        // 2. PROSES NAMA KALIBRATOR DAN PEMERIKSA
        // ==================================================================
        $namaKalibrator = trim($request->calibrated_by ?? '');
        $namaPemeriksa = trim($request->verified_by ?? '');
        
        \Log::info('👤 Nama Kalibrator:', ['nama' => $namaKalibrator]);
        \Log::info('👤 Nama Pemeriksa:', ['nama' => $namaPemeriksa]);

        // ==================================================================
        // 3. SIMPAN KE HEAD PIN GAUGE
        // ==================================================================
        $head = HeadPinGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue,
            'calibrationMethod' => 'PAS-IK1102-49', // Sesuai form Pin Gauge: PAS-IK1102-49
        ]);

        \Log::info('✅ HeadPinGauge saved:', ['head_id' => $head->id]);

        // ==================================================================
        // 4. SIMPAN DETAIL PIN GAUGE (BERDASARKAN 22 BARIS)
        // ==================================================================
        \Log::info('📊 Saving DetailPinGauge data...');
        $detailCount = 0;
        
        // Tentukan jumlah baris - PIN GAUGE selalu 22 baris (1-22)
        $jumlahBaris = 22;
        
        \Log::info('📝 Jumlah baris pin gauge:', ['jumlah_baris' => $jumlahBaris]);
        
        // Proses setiap baris dari 1 sampai 22
        for ($row = 1; $row <= $jumlahBaris; $row++) {
            // Ambil data dari input form sesuai nama input HTML dari tabel
            $nominal = $request->{"nominal_$row"} ?? null;
            $atas1 = $request->{"atas_{$row}_1"} ?? null;
            $atas4 = $request->{"atas_{$row}_4"} ?? null;
            $tengah2 = $request->{"tengah_{$row}_2"} ?? null;
            $tengah5 = $request->{"tengah_{$row}_5"} ?? null;
            $bawah3 = $request->{"bawah_{$row}_3"} ?? null;
            $bawah6 = $request->{"bawah_{$row}_6"} ?? null;
            
            \Log::debug("🔍 Row {$row} data from request:", [
                'nominal' => $nominal,
                'atas_1' => $atas1,
                'tengah_2' => $tengah2,
                'bawah_3' => $bawah3,
                'atas_4' => $atas4,
                'tengah_5' => $tengah5,
                'bawah_6' => $bawah6,
            ]);
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($nominal) || 
                      !empty($atas1) || !empty($tengah2) || !empty($bawah3) || 
                      !empty($atas4) || !empty($tengah5) || !empty($bawah6);
            
            if ($hasData) {
                // MAPPING KE MODEL DetailPinGauge sesuai field database
                // Mapping: titikUkur → nominal, ulangan1-6 → posisi pengukuran
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $this->formatNumericValue($nominal),  // nominal_X
                    'ulangan1' => $this->formatNumericValue($atas1),     // atas_X_1
                    'ulangan2' => $this->formatNumericValue($tengah2),   // tengah_X_2
                    'ulangan3' => $this->formatNumericValue($bawah3),    // bawah_X_3
                    'ulangan4' => $this->formatNumericValue($atas4),     // atas_X_4
                    'ulangan5' => $this->formatNumericValue($tengah5),   // tengah_X_5
                    'ulangan6' => $this->formatNumericValue($bawah6),    // bawah_X_6
                ];
                
                \Log::debug("💾 Saving DetailPinGauge row {$row}:", $detailData);
                
                DetailPinGauge::create($detailData);
                $detailCount++;
                
                \Log::debug("✅ Saved Pin Gauge row {$row}");
            } else {
                \Log::debug("⏭️ Skipping row {$row} - no data");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailPinGauge records");

        // ==================================================================
        // 5. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        // Update nama kalibrator (jika diisi)
        if (!empty($namaKalibrator)) {
            $updateData['calibrated_by'] = $namaKalibrator;
            \Log::info('📝 Nama dikalibrasi:', ['nama' => $namaKalibrator]);
        }
        
        // Update nama pemeriksa (jika diisi)
        if (!empty($namaPemeriksa)) {
            $updateData['verified_by'] = $namaPemeriksa;
            \Log::info('📝 Nama diperiksa:', ['nama' => $namaPemeriksa]);
        }
        
        // Update uncertainty dan keterangan global (jika ada)
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Update satuan jika ada (sesuai input "Unit (......)")
        if ($request->filled('unit_pin_gauge')) {
            $updateData['unit'] = $request->unit_pin_gauge;
            \Log::info('📏 Satuan pin gauge:', ['unit' => $request->unit_pin_gauge]);
        }
        
        // Update kondisi lingkungan khusus untuk pin gauge
        $environmentData = [];
        
        if ($request->filled('temperature')) {
            $environmentData['temperature'] = $request->temperature;
        }
        
        if ($request->filled('humidity')) {
            $environmentData['humidity'] = $request->humidity;
        }
        
        if (!empty($environmentData)) {
            $updateData['environment_condition'] = json_encode($environmentData);
            \Log::info('🌡️ Kondisi lingkungan:', $environmentData);
        }
        
        // Tambahan: Update range jika ada di form Pin Gauge
        if ($request->filled('range_pin_gauge')) {
            $updateData['range'] = $request->range_pin_gauge;
            \Log::info('📐 Range pin gauge:', ['range' => $request->range_pin_gauge]);
        }
        
        // Tambahan: Update resolusi jika ada di form Pin Gauge
        if ($request->filled('resolution_pin_gauge')) {
            $updateData['resolution'] = $request->resolution_pin_gauge;
            \Log::info('🔍 Resolusi pin gauge:', ['resolution' => $request->resolution_pin_gauge]);
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::info('✅ Calibration updated with additional data');
        }

        // ==================================================================
        // 6. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailPinGauge::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (Pin Gauge):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'total_rows' => $jumlahBaris,
            'certificate_id' => $certificateId,
            'alat_standar' => $standardValue,
            'alat_standar_checkbox' => $checkboxAlatStandar,
            'calibrated_by' => $calibration->calibrated_by ?? null,
            'verified_by' => $calibration->verified_by ?? null,
            'unit' => $calibration->unit ?? null,
            'range' => $calibration->range ?? null,
            'resolution' => $calibration->resolution ?? null,
            'environment_condition' => $calibration->environment_condition ?? null,
        ]);

        \Log::info('🎉 storePinGauge COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storePinGauge:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailPinGauge::where('calibration_id', $calibration->id)->delete();
                $head->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data Pin Gauge: " . $e->getMessage());
    }
}


private function storeViscoCup($request, $calibration, $certificateId)
{
    try {
        \Log::info('🚀 START storeViscoCup');
        
        // ==================================================================
        // 1. PROSES ALAT STANDAR DAN TYPE
        // ==================================================================
        
        // Ambil alat standar yang dipilih (radio button array)
        $alatStandarArray = $request->alat_standar ?? [];
        $alatStandar = !empty($alatStandarArray) ? $alatStandarArray[0] : '';
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandar]);
        
        // Ambil type berdasarkan alat standar yang dipilih
        $typeSelected = '';
        if ($alatStandar === 'Viscosity Standard Paragon') {
            $typeSelected = $request->viscosity_type ?? '';
            \Log::info('🔧 Viscosity type selected:', ['type' => $typeSelected]);
        } elseif ($alatStandar === 'Digital Stopwatch') {
            $typeSelected = $request->stopwatch_type ?? '';
            \Log::info('🔧 Stopwatch type selected:', ['type' => $typeSelected]);
        } elseif ($alatStandar === 'Thermometer') {
            $typeSelected = $request->thermometer_type ?? '';
            \Log::info('🔧 Thermometer type selected:', ['type' => $typeSelected]);
        }
        
        // FORMAT: "AlatStandar TYPE" (misal: "Thermometer TAS")
        $standardValue = $alatStandar;
        if (!empty($typeSelected)) {
            $standardValue .= ' ' . $typeSelected; // Format: "Thermometer TAS"
        }
        
        // ==================================================================
        // 2. PROSES TYPE CUP DAN KODE NOMOR (untuk AddViscoCup) - REVISI
        // ==================================================================
        
        // Kumpulkan semua pilihan type cup dalam array
        $typeCupArray = [];
        
        // 1. Cek radio button type_cup (bisa multiple karena mungkin array)
        $typeCupInput = $request->type_cup;
        
        if (is_array($typeCupInput)) {
            // Jika multiple selection (checkbox style)
            foreach ($typeCupInput as $type) {
                if (!empty($type) && $type !== 'Others') {
                    $typeCupArray[] = $type;
                }
            }
        } elseif (!empty($typeCupInput) && $typeCupInput !== 'Others') {
            // Jika single selection (radio button)
            $typeCupArray[] = $typeCupInput;
        }
        
        // 2. Cek jika ada Others yang dipilih
        $othersRadio = $request->others ?? '';
        $typeOtherInput = trim($request->type_other ?? '');
        $othersValue = '';
        
        // Tentukan nilai untuk field "others"
        if ($othersRadio === 'Others' && !empty($typeOtherInput)) {
            // Jika Others dipilih dan ada input text
            $othersValue = $typeOtherInput;
            // Tambahkan "Others" ke array type cup
            if (!in_array('Others', $typeCupArray)) {
                $typeCupArray[] = 'Others';
            }
        } elseif (!empty($typeOtherInput) && $othersRadio !== 'Others') {
            // Jika user mengisi input text tanpa memilih radio Others
            $othersValue = $typeOtherInput;
            // Tambahkan "Others" ke array type cup
            if (!in_array('Others', $typeCupArray)) {
                $typeCupArray[] = 'Others';
            }
        }
        
        // Gabungkan semua type cup dengan koma (tidak termasuk nilai custom)
        $typeCupCombined = !empty($typeCupArray) ? implode(', ', $typeCupArray) : '';
        
        // Ambil kode nomor
        $kodeNomor = $request->kode_nomor ?? ''; // 1, 2, 3, 4, atau 5
        
        \Log::info('🥤 AddViscoCup Data:', [
            'type_cup_array' => $typeCupArray,
            'type_cup_combined' => $typeCupCombined,
            'kode_nomor' => $kodeNomor,
            'others_value' => $othersValue,
            'type_other_input' => $typeOtherInput,
            'others_radio' => $othersRadio
        ]);
        
        // Simpan ke AddViscoCup jika ada data
        if (!empty($typeCupCombined) || !empty($kodeNomor) || !empty($othersValue)) {
            AddViscoCup::create([
                'calibration_id' => $calibration->id,
                'type' => $typeCupCombined, // Contoh: "ZAHN Cup, FORD Cup, Others"
                'kodeNomor' => $kodeNomor,
                'others' => $othersValue, // Nilai custom dari input text Others
            ]);
            \Log::info('✅ AddViscoCup saved');
        }
        
        // Catatan hanya dari input catatan_penting saja
        $catatan = trim($request->catatan_penting ?? '');
        
        // ==================================================================
        // 3. PROSES NAMA KALIBRATOR DAN PEMERIKSA
        // ==================================================================
        $namaKalibrator = trim($request->calibrated_by ?? '');
        $namaPemeriksa = trim($request->verified_by ?? '');
        
        \Log::info('👤 Nama Kalibrator:', ['nama' => $namaKalibrator]);
        \Log::info('👤 Nama Pemeriksa:', ['nama' => $namaPemeriksa]);

        // ==================================================================
        // 4. SIMPAN KE HEAD VISCOCUP
        // ==================================================================
        $head = HeadViscoCup::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $standardValue, // Contoh: "Thermometer TAS"
            'calibrationMethod' => 'PAS-IK1102-43B',
            'catatan' => $catatan, // Hanya dari input catatan_penting
        ]);

        \Log::info('✅ HeadViscoCup saved:', [
            'head_id' => $head->id,
            'standard' => $standardValue,
            'catatan' => $catatan
        ]);

        // ==================================================================
        // 5. SIMPAN DETAIL VISCOCUP (3 BARIS DATA)
        // ==================================================================
        \Log::info('📊 Saving DetailViscoCup data...');
        $detailCount = 0;
        
        // Proses 3 baris data
        for ($row = 1; $row <= 3; $row++) {
            // Ambil data dari input form
            $nilaiStandar = $request->{"kode_nilai_$row"} ?? null;
            $ulangan1 = $request->{"stopwatch_{$row}_1"} ?? null;
            $ulangan2 = $request->{"stopwatch_{$row}_2"} ?? null;
            $ulangan3 = $request->{"stopwatch_{$row}_3"} ?? null;
            $ulangan4 = $request->{"stopwatch_{$row}_4"} ?? null;
            $ulangan5 = $request->{"stopwatch_{$row}_5"} ?? null;
            $suhuCRM = $request->{"suhu_$row"} ?? null;
            
            // Cek apakah ada data untuk baris ini
            $hasData = !empty($nilaiStandar) || 
                      !empty($ulangan1) || !empty($ulangan2) || !empty($ulangan3) || 
                      !empty($ulangan4) || !empty($ulangan5) || 
                      !empty($suhuCRM);
            
            if ($hasData) {
                // MAPPING KE MODEL DetailViscoCup
                $detailData = [
                    'head_visco_cup_id' => $head->id,
                    'calibration_id' => $calibration->id,
                    'nilaiStandar' => $this->formatNumericValue($nilaiStandar),
                    'ulangan1' => $this->formatNumericValue($ulangan1),
                    'ulangan2' => $this->formatNumericValue($ulangan2),
                    'ulangan3' => $this->formatNumericValue($ulangan3),
                    'ulangan4' => $this->formatNumericValue($ulangan4),
                    'ulangan5' => $this->formatNumericValue($ulangan5),
                    'suhuCRM' => $this->formatNumericValue($suhuCRM),
                ];
                
                DetailViscoCup::create($detailData);
                $detailCount++;
                
                \Log::debug("✅ Saved ViscoCup row {$row}");
            }
        }
        
        \Log::info("✅ Saved {$detailCount} DetailViscoCup records");

        // ==================================================================
        // 6. UPDATE CALIBRATION DENGAN DATA TAMBAHAN
        // ==================================================================
        $updateData = [];
        
        // Update nama kalibrator (jika diisi)
        if (!empty($namaKalibrator)) {
            $updateData['calibrated_by'] = $namaKalibrator;
        }
        
        // Update nama pemeriksa (jika diisi)
        if (!empty($namaPemeriksa)) {
            $updateData['verified_by'] = $namaPemeriksa;
        }
        
        // Update uncertainty dan keterangan (jika ada)
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        // Update satuan jika ada
        if ($request->filled('unit')) {
            $updateData['unit'] = $request->unit;
        }
        
        // Update range jika ada
        if ($request->filled('range')) {
            $updateData['range'] = $request->range;
        }
        
        // Update kondisi lingkungan
        $environmentData = [];
        
        if ($request->filled('temperature')) {
            $environmentData['temperature'] = $request->temperature;
        }
        
        if ($request->filled('humidity')) {
            $environmentData['humidity'] = $request->humidity;
        }
        
        if (!empty($environmentData)) {
            $updateData['environment_condition'] = json_encode($environmentData);
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
        }

        // ==================================================================
        // 7. LOG HASIL AKHIR
        // ==================================================================
        $savedDetailCount = DetailViscoCup::where('calibration_id', $calibration->id)->count();
        $addViscoCupCount = AddViscoCup::where('calibration_id', $calibration->id)->count();
        
        \Log::info('📋 STORE SUMMARY (ViscoCup):', [
            'calibration_id' => $calibration->id,
            'head_id' => $head->id,
            'detail_records' => $savedDetailCount,
            'add_visco_cup_records' => $addViscoCupCount,
            'certificate_id' => $certificateId,
            'alat_standar' => $alatStandar,
            'type_selected' => $typeSelected,
            'standard_value' => $standardValue, // "Thermometer TAS"
            'type_cup_array' => $typeCupArray,
            'type_cup_combined' => $typeCupCombined,
            'kode_nomor' => $kodeNomor,
            'others_value' => $othersValue,
            'catatan' => $catatan, // Hanya dari catatan_penting
            'calibrated_by' => $namaKalibrator,
            'verified_by' => $namaPemeriksa,
        ]);

        \Log::info('🎉 storeViscoCup COMPLETED');
        return true;

    } catch (\Exception $e) {
        \Log::error('💥 ERROR storeViscoCup:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'calibration_id' => $calibration->id ?? 'N/A',
            'trace' => $e->getTraceAsString()
        ]);
        
        // Rollback sederhana
        if (isset($head) && $head->id) {
            try {
                DetailViscoCup::where('head_visco_cup_id', $head->id)->delete();
                $head->delete();
                // Juga hapus AddViscoCup jika ada
                AddViscoCup::where('calibration_id', $calibration->id)->delete();
            } catch (\Exception $rollbackError) {
                \Log::error('💥 Rollback failed:', ['error' => $rollbackError->getMessage()]);
            }
        }
        
        throw new \Exception("Gagal menyimpan data ViscoCup: " . $e->getMessage());
    }
}

private function storePlainLimitGauge($request, $calibration, $certificateId)
{
    try {
        // Inisialisasi array untuk menyimpan alat standar
        $alatStandarArray = [];
        
        // Cek checkbox yang dipilih
        $alatStandar = $request->alat_standar ?? [];
        
        \Log::info('🔧 Alat standar selected for Plain Limit Gauge:', ['alat_standar' => $alatStandar]);

        // Get additional mm selections
        $gaugeBlockMm = $request->gauge_block_mm ?? '';
        $ringGaugeMm = $request->ring_gauge_mm ?? '';
        
        \Log::info('📏 Additional mm selections:', [
            'gauge_block_mm' => $gaugeBlockMm,
            'ring_gauge_mm' => $ringGaugeMm
        ]);

        // Proses checkbox untuk menambahkan ke array alat standar
        if (!empty($alatStandar)) {
            foreach ($alatStandar as $alat) {
                $alatStandarArray[] = $alat;
            }
        }

        // Tambahkan Gauge Block dengan ukuran mm jika dipilih
        if ($gaugeBlockMm) {
            $alatStandarArray[] = "Gauge Block {$gaugeBlockMm} mm";
        }

        // Tambahkan Ring Gauge dengan ukuran mm jika dipilih
        if ($ringGaugeMm) {
            $alatStandarArray[] = "Ring Gauge {$ringGaugeMm} mm";
        }

        // Konversi array menjadi string dengan pemisah koma
        $alatStandarString = !empty($alatStandarArray) ? implode(', ', $alatStandarArray) : '';
        
        \Log::info('📋 Final alat standar string:', ['alat_standar_string' => $alatStandarString]);

        // Simpan ke Head Plain Limit Gauge
        $head = HeadPlainLimitGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-63',
            'catatan' => $request->catatan ?? '',
            // Tambahkan kolom untuk dikalibrasi_oleh dan diperiksa_oleh jika diperlukan
            // 'dikalibrasi_oleh' => $request->calibrated_by ?? '',
            // 'diperiksa_oleh' => $request->verified_by ?? '',
        ]);

        \Log::info('✅ Head Plain Limit Gauge saved:', ['head_id' => $head->id]);

        // Simpan detail measurements
        \Log::info('📊 Saving detail measurements...');
        
        // Konversi nilai menjadi float jika ada
        function convertToFloat($value) {
            if (empty($value) || $value === '') {
                return null;
            }
            // Ganti koma dengan titik untuk format desimal
            $value = str_replace(',', '.', $value);
            return (float) $value;
        }

        // Data GO
        $goData = [
            'calibration_id' => $calibration->id,
            'titikUkurGO' => convertToFloat($request->go_nominal),
            'posisiAtasX1' => convertToFloat($request->go_atas_x),
            'posisiAtasX2' => convertToFloat($request->go_atas_x2),
            'posisiAtasY1' => convertToFloat($request->go_atas_y),
            'posisiAtasY2' => convertToFloat($request->go_atas_y2),
            'posisiBawahX1' => convertToFloat($request->go_bawah_x),
            'posisiBawahX2' => convertToFloat($request->go_bawah_x2),
            'posisiBawahY1' => convertToFloat($request->go_bawah_y),
            'posisiBawahY2' => convertToFloat($request->go_bawah_y2),
        ];

        // Data NO GO
        $nogoData = [
            'titikUkurNOGO' => convertToFloat($request->nogo_nominal),
            'sumbuAtasX1' => convertToFloat($request->nogo_atas_x),
            'sumbuAtasX2' => convertToFloat($request->nogo_atas_x2),
            'sumbuAtasY1' => convertToFloat($request->nogo_atas_y),
            'sumbuAtasY2' => convertToFloat($request->nogo_atas_y2),
            'sumbuBawahX1' => convertToFloat($request->nogo_bawah_x),
            'sumbuBawahX2' => convertToFloat($request->nogo_bawah_x2),
            'sumbuBawahY1' => convertToFloat($request->nogo_bawah_y),
            'sumbuBawahY2' => convertToFloat($request->nogo_bawah_y2),
        ];

        // Gabungkan data GO dan NO GO
        $detailData = array_merge($goData, $nogoData);
        
        \Log::info('📝 Saving detail measurement:', $detailData);
        
        DetailPlainLimitGauge::create($detailData);
        
        \Log::info('✅ Detail Plain Limit Gauge saved successfully');

        // Simpan informasi dikalibrasi_oleh dan diperiksa_oleh jika perlu
        if ($request->has('calibrated_by') && !empty(trim($request->calibrated_by))) {
            \Log::info('👤 Calibrated by saved:', ['name' => $request->calibrated_by]);
            // Simpan ke calibration table atau table lain jika diperlukan
        }
        
        if ($request->has('verified_by') && !empty(trim($request->verified_by))) {
            \Log::info('👤 Verified by saved:', ['name' => $request->verified_by]);
            // Simpan ke calibration table atau table lain jika diperlukan
        }

        \Log::info('🎉 Plain Limit Gauge data saved successfully');

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Plain Limit Gauge data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

private function storeTempHumidTransmitter($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🌡️ Alat standar selected for TempHumidTransmitter:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head TempHumidTransmitter
        $head = HeadTempHumidTransmitter::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-67',
            'tertelusur' => 'Certus Metrology',
        ]);

        \Log::info('✅ Head TempHumidTransmitter saved:', ['head_id' => $head->id]);

        // Simpan detail measurements untuk Temperature (T) - 8 BARIS
        \Log::info('🌡️ Saving temperature (T) detail measurements...');
        $temperatureCount = 0;
        
        for ($i = 1; $i <= 8; $i++) { // 8 BARIS UNTUK TEMPERATURE
            // Cek apakah ada data untuk baris ini
            $hasTemperatureData = false;
            
            // Cek apakah ada T_STD atau T_OSmA yang diisi
            for ($j = 1; $j <= 3; $j++) {
                if ($request->has("T_STD{$i}_{$j}") && !empty(trim($request->{"T_STD{$i}_{$j}"}))) {
                    $hasTemperatureData = true;
                    break;
                }
                if ($request->has("T_OSmA{$i}_{$j}") && !empty(trim($request->{"T_OSmA{$i}_{$j}"}))) {
                    $hasTemperatureData = true;
                    break;
                }
            }
            
            // Simpan jika ada data T_setting atau T_STD/T_OSmA
            if (($request->has("T_setting_{$i}") && !empty(trim($request->{"T_setting_{$i}"}))) || $hasTemperatureData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'T_setting' => $request->{"T_setting_{$i}"} ?? null,
                    'T_STD1' => $request->{"T_STD{$i}_1"} ?? null,
                    'T_STD2' => $request->{"T_STD{$i}_2"} ?? null,
                    'T_STD3' => $request->{"T_STD{$i}_3"} ?? null,
                    'T_OSmA1' => $request->{"T_OSmA{$i}_1"} ?? null,
                    'T_OSmA2' => $request->{"T_OSmA{$i}_2"} ?? null,
                    'T_OSmA3' => $request->{"T_OSmA{$i}_3"} ?? null,
                ];

                \Log::info("🌡️ Saving temperature (T) detail row $i:", $detailData);
                
                Detail_T_TempHumidTransmitter::create($detailData);
                $temperatureCount++;
            }
        }
        
        \Log::info("✅ Saved $temperatureCount temperature (T) detail measurements");

        // Simpan detail measurements untuk Humidity (RH) - 7 BARIS
        \Log::info('💧 Saving humidity (RH) detail measurements...');
        $humidityCount = 0;
        
        for ($i = 1; $i <= 7; $i++) { // 7 BARIS UNTUK HUMIDITY
            // Cek apakah ada data untuk baris ini
            $hasHumidityData = false;
            
            // Cek apakah ada RH_STD atau RH_OSmA yang diisi
            for ($j = 1; $j <= 3; $j++) {
                if ($request->has("RH_STD{$i}_{$j}") && !empty(trim($request->{"RH_STD{$i}_{$j}"}))) {
                    $hasHumidityData = true;
                    break;
                }
                if ($request->has("RH_OSmA{$i}_{$j}") && !empty(trim($request->{"RH_OSmA{$i}_{$j}"}))) {
                    $hasHumidityData = true;
                    break;
                }
            }
            
            // Simpan jika ada data RH_setting atau RH_STD/RH_OSmA
            if (($request->has("RH_setting_{$i}") && !empty(trim($request->{"RH_setting_{$i}"}))) || $hasHumidityData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'RH_setting' => $request->{"RH_setting_{$i}"} ?? null,
                    'RH_STD1' => $request->{"RH_STD{$i}_1"} ?? null,
                    'RH_STD2' => $request->{"RH_STD{$i}_2"} ?? null,
                    'RH_STD3' => $request->{"RH_STD{$i}_3"} ?? null,
                    'RH_OSmA1' => $request->{"RH_OSmA{$i}_1"} ?? null,
                    'RH_OSmA2' => $request->{"RH_OSmA{$i}_2"} ?? null,
                    'RH_OSmA3' => $request->{"RH_OSmA{$i}_3"} ?? null,
                ];

                \Log::info("💧 Saving humidity (RH) detail row $i:", $detailData);
                
                Detail_RH_TempHumidTransmitter::create($detailData);
                $humidityCount++;
            }
        }
        
        \Log::info("✅ Saved $humidityCount humidity (RH) detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing TempHumidTransmitter data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

private function storeTempTransmitter($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        // Pastikan indicator dan media diambil sebagai array
        $indicator = $request->indicator ?? [];
        $indicatorString = !empty($indicator) ? implode(', ', $indicator) : '';
        
        $media = $request->media ?? [];
        $mediaString = !empty($media) ? implode(', ', $media) : '';
        
        // Debug log untuk melihat data yang diterima
        \Log::info('🌡️ Data untuk TempTransmitter:', [
            'alat_standar' => $alatStandar,
            'alat_standar_string' => $alatStandarString,
            'indicator' => $indicator,
            'indicator_string' => $indicatorString,
            'media' => $media,
            'media_string' => $mediaString,
            'all_request_data' => $request->all() // Lihat semua data request
        ]);

        // Simpan ke Head TempTransmitter
        $head = HeadTempTransmitter::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-66 (Temp. Transmitter)',
            'indicator' => $indicatorString,
            'media' => $mediaString,
        ]);

        \Log::info('✅ Head TempTransmitter saved:', ['head_id' => $head->id]);

        // Simpan nama penandatangan ke calibration
        $calibration->update([
            'calibratedBy' => $request->calibrated_by ?? '',
            'verifiedBy' => $request->verified_by ?? '',
        ]);

        \Log::info('✅ Penandatangan saved:', [
            'calibratedBy' => $request->calibrated_by ?? '',
            'verifiedBy' => $request->verified_by ?? ''
        ]);

        // Simpan detail measurements - 10 records (5 kiri + 5 kanan)
        \Log::info('🌡️ Saving temperature detail measurements...');
        $detailCount = 0;
        
        // SIMPAN DATA KIRI (5 records)
        for ($group = 1; $group <= 5; $group++) {
            $T_setting_kiri = $request->{"setting_suhu_kiri_{$group}"} ?? null;
            
            // Cek apakah ada data untuk grup kiri ini
            $hasLeftData = false;
            
            // Cek apakah ada STD atau Indicator yang diisi
            for ($row = 1; $row <= 3; $row++) {
                if ($request->has("std_kiri_{$group}_{$row}") && !empty(trim($request->{"std_kiri_{$group}_{$row}"}))) {
                    $hasLeftData = true;
                    break;
                }
                if ($request->has("indicator_kiri_{$group}_{$row}") && !empty(trim($request->{"indicator_kiri_{$group}_{$row}"}))) {
                    $hasLeftData = true;
                    break;
                }
            }
            
            // Simpan jika ada data
            if (!empty($T_setting_kiri) || $hasLeftData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'T_setting' => $T_setting_kiri,
                    'T_STD1' => $request->{"std_kiri_{$group}_1"} ?? null,
                    'T_STD2' => $request->{"std_kiri_{$group}_2"} ?? null,
                    'T_STD3' => $request->{"std_kiri_{$group}_3"} ?? null,
                    'T_Indicator1' => $request->{"indicator_kiri_{$group}_1"} ?? null,
                    'T_Indicator2' => $request->{"indicator_kiri_{$group}_2"} ?? null,
                    'T_Indicator3' => $request->{"indicator_kiri_{$group}_3"} ?? null,
                ];

                \Log::info("🌡️ Saving LEFT data - Group {$group}:", $detailData);
                
                DetailTempTransmitter::create($detailData);
                $detailCount++;
            }
        }
        
        // SIMPAN DATA KANAN (5 records)
        for ($group = 1; $group <= 5; $group++) {
            $T_setting_kanan = $request->{"setting_suhu_kanan_{$group}"} ?? null;
            
            // Cek apakah ada data untuk grup kanan ini
            $hasRightData = false;
            
            // Cek apakah ada STD atau Indicator yang diisi
            for ($row = 1; $row <= 3; $row++) {
                if ($request->has("std_kanan_{$group}_{$row}") && !empty(trim($request->{"std_kanan_{$group}_{$row}"}))) {
                    $hasRightData = true;
                    break;
                }
                if ($request->has("indicator_kanan_{$group}_{$row}") && !empty(trim($request->{"indicator_kanan_{$group}_{$row}"}))) {
                    $hasRightData = true;
                    break;
                }
            }
            
            // Simpan jika ada data
            if (!empty($T_setting_kanan) || $hasRightData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'T_setting' => $T_setting_kanan,
                    'T_STD1' => $request->{"std_kanan_{$group}_1"} ?? null,
                    'T_STD2' => $request->{"std_kanan_{$group}_2"} ?? null,
                    'T_STD3' => $request->{"std_kanan_{$group}_3"} ?? null,
                    'T_Indicator1' => $request->{"indicator_kanan_{$group}_1"} ?? null,
                    'T_Indicator2' => $request->{"indicator_kanan_{$group}_2"} ?? null,
                    'T_Indicator3' => $request->{"indicator_kanan_{$group}_3"} ?? null,
                ];

                \Log::info("🌡️ Saving RIGHT data - Group {$group}:", $detailData);
                
                DetailTempTransmitter::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing TempTransmitter data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

private function storeIrThermometer($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandar]);
        $satuanSuhu = $request->satuan_suhu;

        // Simpan ke Head IrThermometer
        $head = HeadIrThermometer::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-47',
            'satuan_suhu' => $satuanSuhu,
        ]);

        \Log::info('✅ Head IrThermometer saved:', ['head_id' => $head->id]);

        // Simpan data jarak kalibrasi ke AddIrThermometer
        if ($request->has('merek') && !empty(trim($request->merek))) {
            AddIrThermometer::create([
                'calibration_id' => $calibration->id,
                'jarakKalibrasi' => $request->jarak_kalibrasi,
            ]);
            \Log::info('✅ Jarak kalibrasi saved:', ['jarak' => $request->jarak_kalibrasi]);
        }

        // Simpan detail measurements untuk tabel kiri (1-5)
        \Log::info('📊 Saving detail measurements for left table (1-5)...');
        $detailCount = 0;
        
        // Data 1-5 (tabel kiri)
        for ($i = 1; $i <= 5; $i++) {
            $settingSuhuField = "setting_suhu_$i";
            
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada STD/UUT yang diisi
            $startStd = (($i - 1) * 3) + 1;
            for ($j = 0; $j < 3; $j++) {
                $stdField = "std_" . ($startStd + $j);
                $uutField = "uut_" . ($startStd + $j);
                
                if (($request->has($stdField) && !empty(trim($request->{$stdField}))) || 
                    ($request->has($uutField) && !empty(trim($request->{$uutField})))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data setting suhu atau STD/UUT
            if (($request->has($settingSuhuField) && !empty(trim($request->{$settingSuhuField}))) || $hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'head_ir_thermometer_id' => $head->id, // ✅ Tambahkan foreign key ke head
                    'titikUkur' => $request->{$settingSuhuField} ?? null,
                    'STD01' => $request->{"std_" . $startStd} ?? null,
                    'STD02' => $request->{"std_" . ($startStd + 1)} ?? null,
                    'STD03' => $request->{"std_" . ($startStd + 2)} ?? null,
                    'UUT01' => $request->{"uut_" . $startStd} ?? null,
                    'UUT02' => $request->{"uut_" . ($startStd + 1)} ?? null,
                    'UUT03' => $request->{"uut_" . ($startStd + 2)} ?? null,
                ];

                \Log::info("📝 Saving left table row $i:", $detailData);
                
                DetailIrThermometer::create($detailData);
                $detailCount++;
            }
        }

        // Simpan detail measurements untuk tabel kanan (6-10)
        \Log::info('📊 Saving detail measurements for right table (6-10)...');
        
        // Data 6-10 (tabel kanan)
        for ($i = 6; $i <= 10; $i++) {
            $settingSuhuField = "setting_suhu_$i";
            
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada STD/UUT yang diisi
            $startStd = (($i - 1) * 3) + 1;
            for ($j = 0; $j < 3; $j++) {
                $stdField = "std_" . ($startStd + $j);
                $uutField = "uut_" . ($startStd + $j);
                
                if (($request->has($stdField) && !empty(trim($request->{$stdField}))) || 
                    ($request->has($uutField) && !empty(trim($request->{$uutField})))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data setting suhu atau STD/UUT
            if (($request->has($settingSuhuField) && !empty(trim($request->{$settingSuhuField}))) || $hasData) {
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'head_ir_thermometer_id' => $head->id, // ✅ Tambahkan foreign key ke head
                    'titikUkur' => $request->{$settingSuhuField} ?? null,
                    'STD01' => $request->{"std_" . $startStd} ?? null,
                    'STD02' => $request->{"std_" . ($startStd + 1)} ?? null,
                    'STD03' => $request->{"std_" . ($startStd + 2)} ?? null,
                    'UUT01' => $request->{"uut_" . $startStd} ?? null,
                    'UUT02' => $request->{"uut_" . ($startStd + 1)} ?? null,
                    'UUT03' => $request->{"uut_" . ($startStd + 2)} ?? null,
                ];

                \Log::info("📝 Saving right table row $i:", $detailData);
                
                DetailIrThermometer::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements for IrThermometer");

        // Simpan data calibrated_by dan verified_by jika ada
        if ($request->has('calibrated_by') && !empty(trim($request->calibrated_by))) {
            // Anda bisa menyimpan ini ke tabel lain atau ke HeadIrThermometer
            // Jika perlu disimpan di HeadIrThermometer, tambahkan field di model
            \Log::info('📝 Calibrated by:', ['name' => $request->calibrated_by]);
        }
        
        if ($request->has('verified_by') && !empty(trim($request->verified_by))) {
            \Log::info('📝 Verified by:', ['name' => $request->verified_by]);
        }
        
        // Simpan satuan suhu jika ada
        if ($request->has('satuan_suhu') && !empty(trim($request->satuan_suhu))) {
            \Log::info('🌡️ Satuan suhu:', ['satuan' => $request->satuan_suhu]);
        }

    } catch (\Exception $e) {
        \Log::error('💥 Error storing IrThermometer data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}


private function storeThermoindicator($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🌡️ Alat standar selected untuk Thermoindicator:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head ThermoIndicator
        $head = HeadThermoIndicator::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-37',
            'satuan_std' => $request->satuan_std ?? '°C',
            'satuan_uut' => $request->satuan_uut ?? '°C',
        ]);

        \Log::info('✅ Head ThermoIndicator saved:', ['head_id' => $head->id]);

        // Simpan detail measurements untuk ThermoIndicator
        \Log::info('📊 Saving ThermoIndicator detail measurements...');
        $detailCount = 0;
        
        // Tabel Kiri (baris 1-10)
        for ($i = 1; $i <= 10; $i++) {
            // Ambil data pembacaan alat kiri (array)
            $pembacaanAlatKiri = $request->pembacaan_alat_kiri ?? [];
            $PenunjukanSTD = isset($pembacaanAlatKiri[$i-1]) ? $pembacaanAlatKiri[$i-1] : null;
            
            // Cek apakah ada data untuk baris ini
            if (!empty($PenunjukanSTD) || 
                $request->has("naik_kiri_$i") || 
                $request->has("turun_kiri_$i")) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'PenunjukanSTD' => $PenunjukanSTD,
                    'UUTnaik' => $request->{"naik_kiri_$i"} ?? null,
                    'UUTturun' => $request->{"turun_kiri_$i"} ?? null,
                ];

                \Log::info("📝 Saving ThermoIndicator detail row kiri $i:", $detailData);
                
                DetailThermoIndicator::create($detailData);
                $detailCount++;
            }
        }
        
        // Tabel Kanan (baris 11-20)
        for ($i = 11; $i <= 20; $i++) {
            // Ambil data pembacaan alat kanan (array)
            $pembacaanAlatKanan = $request->pembacaan_alat_kanan ?? [];
            // Perhatikan: untuk kanan, indexnya $i-11 karena mulai dari index 0
            $PenunjukanSTD = isset($pembacaanAlatKanan[$i-11]) ? $pembacaanAlatKanan[$i-11] : null;
            
            // Cek apakah ada data untuk baris ini
            if (!empty($PenunjukanSTD) || 
                $request->has("naik_kanan_$i") || 
                $request->has("turun_kanan_$i")) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'PenunjukanSTD' => $PenunjukanSTD,
                    'UUTnaik' => $request->{"naik_kanan_$i"} ?? null,
                    'UUTturun' => $request->{"turun_kanan_$i"} ?? null,
                ];

                \Log::info("📝 Saving ThermoIndicator detail row kanan $i:", $detailData);
                
                DetailThermoIndicator::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount ThermoIndicator detail measurements");

        // Simpan data tambahan (AddThermoIndicator)
        \Log::info('📋 Saving additional ThermoIndicator data...');
        
        // Mapping data repeatability dari input repX_colY ke field rep01-rep05
        $additionalData = [
            'calibration_id' => $calibration->id,
            'wireType' => $request->tipe_wire ?? null,
        ];
        
        // Mapping langsung berdasarkan pola input name
        // Baris 1, Kolom 1-3 -> rep01, rep02, rep03
        // Baris 2, Kolom 1-2 -> rep04, rep05
        
        // Gunakan ternary operator untuk mengambil data
        $additionalData['rep01'] = $request->has('rep1_col1') && !empty(trim($request->rep1_col1)) 
            ? $request->rep1_col1 
            : null;
        
        $additionalData['rep02'] = $request->has('rep1_col2') && !empty(trim($request->rep1_col2)) 
            ? $request->rep1_col2 
            : null;
        
        $additionalData['rep03'] = $request->has('rep1_col3') && !empty(trim($request->rep1_col3)) 
            ? $request->rep1_col3 
            : null;
        
        $additionalData['rep04'] = $request->has('rep2_col1') && !empty(trim($request->rep2_col1)) 
            ? $request->rep2_col1 
            : null;
        
        $additionalData['rep05'] = $request->has('rep2_col2') && !empty(trim($request->rep2_col2)) 
            ? $request->rep2_col2 
            : null;
        
        // Jika ada data rep2_col3 atau baris lainnya, bisa ditambahkan
        if ($request->has('rep2_col3') && !empty(trim($request->rep2_col3))) {
            \Log::info('⚠️ Extra repeatability data rep2_col3 found:', ['value' => $request->rep2_col3]);
            // Jika Anda ingin menyimpan di field lain, tambahkan di sini
        }
        
        // Loop untuk menangani data tambahan jika ada lebih banyak baris
        for ($row = 3; $row <= 10; $row++) {
            for ($col = 1; $col <= 3; $col++) {
                $fieldName = "rep{$row}_col{$col}";
                if ($request->has($fieldName) && !empty(trim($request->$fieldName))) {
                    \Log::info("⚠️ Extra repeatability data {$fieldName} found:", ['value' => $request->$fieldName]);
                }
            }
        }

        // Cek apakah minimal ada satu data yang diisi (selain calibration_id)
        $hasAdditionalData = false;
        foreach ($additionalData as $key => $value) {
            if ($key !== 'calibration_id' && $value !== null && $value !== '') {
                $hasAdditionalData = true;
                break;
            }
        }

        if ($hasAdditionalData) {
            $addThermoIndicator = AddThermoIndicator::create($additionalData);
            \Log::info('✅ Additional ThermoIndicator data saved:', ['additional_id' => $addThermoIndicator->id]);
            \Log::info('📊 Repeatability data:', [
                'rep01' => $additionalData['rep01'] ?? 'null',
                'rep02' => $additionalData['rep02'] ?? 'null',
                'rep03' => $additionalData['rep03'] ?? 'null',
                'rep04' => $additionalData['rep04'] ?? 'null',
                'rep05' => $additionalData['rep05'] ?? 'null',
            ]);
        } else {
            \Log::info('ℹ️ No additional data to save for AddThermoIndicator');
        }

        // Log untuk debugging
        \Log::info('📊 Form data summary:', [
            'pembacaan_alat_kiri_count' => count($request->pembacaan_alat_kiri ?? []),
            'pembacaan_alat_kanan_count' => count($request->pembacaan_alat_kanan ?? []),
            'tipe_wire' => $request->tipe_wire ?? 'null',
            'alat_standar_count' => count($alatStandar),
            'repeatability_data' => [
                'rep1_col1' => $request->rep1_col1 ?? 'null',
                'rep1_col2' => $request->rep1_col2 ?? 'null',
                'rep1_col3' => $request->rep1_col3 ?? 'null',
                'rep2_col1' => $request->rep2_col1 ?? 'null',
                'rep2_col2' => $request->rep2_col2 ?? 'null',
            ],
        ]);

        return $head;

    } catch (\Exception $e) {
        \Log::error('💥 Error storing ThermoIndicator data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

private function storePlasticShim($request, $calibration, $certificateId)
{
    try {
        // Ambil alat standar dari hidden input
        $alatStandarText = $request->alat_standar_text ?? '';
        
        \Log::info('🔧 Alat standar for Plastic Shim:', ['alat_standar_text' => $alatStandarText]);

        // Simpan ke Head Plastic Shim
        $head = HeadPlasticShim::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarText, // Menggunakan alat_standar_text
            'calibrationMethod' => 'PAS-IK1102-60',
            'satuan_unit' => $request->unit_nominal ?? '', // Menyimpan unit (mm atau µm)
        ]);

        \Log::info('✅ Head Plastic Shim saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - 20 BARIS (sesuai tabel)
        \Log::info('📊 Saving Plastic Shim detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 20; $i++) { // 20 baris sesuai tabel
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada penunjukan yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("penunjukan_{$i}_{$j}") && !empty(trim($request->{"penunjukan_{$i}_{$j}"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Cek apakah ada serial number
            $hasSerial = $request->has("serial_number_$i") && !empty(trim($request->{"serial_number_$i"}));
            
            // Simpan jika ada data nominal, serial number, atau penunjukan
            if (($request->has("nominal_$i") && !empty(trim($request->{"nominal_$i"}))) || 
                $hasSerial || 
                $hasData) {
                
                // Konversi ke decimal jika ada nilai
                $nominalValue = $request->{"nominal_$i"} ?? null;
                $nominalValue = $nominalValue ? (float) $nominalValue : null;
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nominal' => $nominalValue,
                    'sn' => $request->{"serial_number_$i"} ?? '',
                    'STD01' => $request->{"penunjukan_{$i}_1"} ? (float) $request->{"penunjukan_{$i}_1"} : null,
                    'STD02' => $request->{"penunjukan_{$i}_2"} ? (float) $request->{"penunjukan_{$i}_2"} : null,
                    'STD03' => $request->{"penunjukan_{$i}_3"} ? (float) $request->{"penunjukan_{$i}_3"} : null,
                    'STD04' => $request->{"penunjukan_{$i}_4"} ? (float) $request->{"penunjukan_{$i}_4"} : null,
                    'STD05' => $request->{"penunjukan_{$i}_5"} ? (float) $request->{"penunjukan_{$i}_5"} : null,
                ];

                \Log::info("📝 Saving Plastic Shim detail row $i:", $detailData);
                
                DetailPlasticShim::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount Plastic Shim detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Plastic Shim data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

private function storeProfilProjector($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Profil Projector:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head Profil Projector
        $head = HeadProfilProjector::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'satuan_titik_ukur' => $request->satuan_titik_ukur ?? '', // Simpan satuan titik ukur
            'satuan_alat_x' => $request->satuan_alat_x ?? '', // Simpan satuan alat X
            'satuan_alat_y' => $request->satuan_alat_y ?? '', // Simpan satuan alat Y
            'calibrationMethod' => 'PAS-IK1102-42', // Sesuaikan dengan metode kalibrasi profil projector
        ]);

        \Log::info('✅ Head Profil Projector saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - 20 BARIS (sesuai tabel)
        \Log::info('📊 Saving Profil Projector detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 20; $i++) { // 20 baris sesuai tabel
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada data X atau Y yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if (($request->has("x_{$i}_{$j}") && !empty(trim($request->{"x_{$i}_{$j}"}))) || 
                    ($request->has("y_{$i}_{$j}") && !empty(trim($request->{"y_{$i}_{$j}"})))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Cek titik ukur
            $hasTitikUkur = $request->has("titik_ukur_{$i}") && !empty(trim($request->{"titik_ukur_{$i}"}));
            
            // Simpan jika ada data titik ukur, X, atau Y
            if ($hasData || $hasTitikUkur) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $request->{"titik_ukur_{$i}"} ?? null,
                    'X1' => $request->{"x_{$i}_1"} ?? null,
                    'X2' => $request->{"x_{$i}_2"} ?? null,
                    'X3' => $request->{"x_{$i}_3"} ?? null,
                    'X4' => $request->{"x_{$i}_4"} ?? null,
                    'X5' => $request->{"x_{$i}_5"} ?? null,
                    'Y1' => $request->{"y_{$i}_1"} ?? null,
                    'Y2' => $request->{"y_{$i}_2"} ?? null,
                    'Y3' => $request->{"y_{$i}_3"} ?? null,
                    'Y4' => $request->{"y_{$i}_4"} ?? null,
                    'Y5' => $request->{"y_{$i}_5"} ?? null,
                ];

                \Log::info("📝 Saving Profil Projector detail row $i:", $detailData);
                
                DetailProfilProjector::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount Profil Projector detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Profil Projector data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}


private function storeSurfaceRoughnessTester($request, $calibration, $certificateId)
{
    try {
        $alatStandarString = $request->alat_standar_text ?? [];
       
        
        \Log::info('🔧 Alat standar Surface Roughness Tester selected:', ['alat_standar' => $alatStandarString]);

        // Simpan ke Head Surface Roughness Tester
        $head = HeadSurfaceRoughnessTester::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-60',
        ]);

        \Log::info('✅ Head Surface Roughness Tester saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - Sesuai dengan jumlah baris yang ada di form
        \Log::info('📊 Saving detail Surface Roughness Tester measurements...');
        $detailCount = 0;
        
        // Asumsi 10 baris atau sesuaikan dengan form Anda
        for ($i = 1; $i <= 10; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada nominal STD
            if ($request->has("nominalSTD_$i") && !empty(trim($request->{"nominalSTD_$i"}))) {
                $hasData = true;
            }
            
            // Cek apakah ada parameter
            if (!$hasData && $request->has("parameter_$i") && !empty(trim($request->{"parameter_$i"}))) {
                $hasData = true;
            }
            
            // Cek apakah ada ukurAlat1, ukurAlat2, atau ukurAlat3
            if (!$hasData) {
                if (($request->has("ukurAlat1_$i") && !empty(trim($request->{"ukurAlat1_$i"}))) ||
                    ($request->has("ukurAlat2_$i") && !empty(trim($request->{"ukurAlat2_$i"}))) ||
                    ($request->has("ukurAlat3_$i") && !empty(trim($request->{"ukurAlat3_$i"})))) {
                    $hasData = true;
                }
            }
            
            // Cek apakah ada CutOff
            if (!$hasData && $request->has("CutOff_$i") && !empty(trim($request->{"CutOff_$i"}))) {
                $hasData = true;
            }
            
            // Simpan jika ada data
            if ($hasData) {
                
                $detailData = [
                    'head_surface_roughness_tester_id' => $head->id,
                    'calibration_id' => $calibration->id,
                    'nominalSTD' => $request->{"nominalSTD_$i"} ?? null,
                    'parameter' => $request->{"parameter_$i"} ?? null,
                    'ukurAlat1' => $request->{"ukurAlat1_$i"} ?? null,
                    'ukurAlat2' => $request->{"ukurAlat2_$i"} ?? null,
                    'ukurAlat3' => $request->{"ukurAlat3_$i"} ?? null,
                    'CutOff' => $request->{"CutOff_$i"} ?? null,
                ];

                \Log::info("📝 Saving Surface Roughness Tester detail row $i:", $detailData);
                
                DetailSurfaceRoughnessTester::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements for Surface Roughness Tester");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Surface Roughness Tester data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}

private function storeUltrasonicThicknessGauge($request, $calibration, $certificateId)
{
    try {
        $alatStandarString = $request->alat_standar_text ?? [];
      
        
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandarString]);

        // Simpan ke Head Ultrasonic Thickness Gauge
        $head = HeadUltrasonicThicknessGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
        ]);

        \Log::info('✅ Head Ultrasonic Thickness Gauge saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - SEKARANG 14 BARIS
        \Log::info('📊 Saving detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 15; $i++) { // UBAH DARI 11 MENJADI 14
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada penunjukan yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("penunjukan_{$i}_{$j}") && !empty(trim($request->{"penunjukan_{$i}_{$j}"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data nominal atau penunjukan
            if (($request->has("nominal_$i") && !empty(trim($request->{"nominal_$i"}))) || $hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nominalSTD' => $request->{"nominal_$i"} ?? '',
                    'ulangan01' => $request->{"penunjukan_{$i}_1"} ?? null,
                    'ulangan02' => $request->{"penunjukan_{$i}_2"} ?? null,
                    'ulangan03' => $request->{"penunjukan_{$i}_3"} ?? null,
                    'ulangan04' => $request->{"penunjukan_{$i}_4"} ?? null,
                    'ulangan05' => $request->{"penunjukan_{$i}_5"} ?? null,
                ];

                \Log::info("📝 Saving detail row $i:", $detailData);
                
                DetailUltrasonicThicknessGauge::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Ultrasonic Thickness Gauge data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}


private function storeThreadGauge($request, $calibration, $certificateId)
{
    try {
        // 1. KELOLA ALAT STANDAR DENGAN DETAIL UKURAN
        $alatStandarItems = [];
        $alatStandarArray = $request->alat_standar ?? [];
        
        // Iterasi setiap alat standar yang dipilih
        foreach ($alatStandarArray as $alat) {
            switch ($alat) {
                case 'Mesin ULM 01-600D':
                    $alatStandarItems[] = $alat;
                    break;
                    
                case 'Gauge Block':
                    // Cek apakah ada nilai gauge block yang dipilih
                    if ($request->filled('gauge_block') && $request->gauge_block !== '') {
                        $alatStandarItems[] = $alat . ' ' . $request->gauge_block . ' mm';
                    } else {
                        $alatStandarItems[] = $alat . ' (tidak ada pilihan ukuran)';
                    }
                    break;
                    
                case 'Ring Gauge':
                    // Cek apakah ada nilai dari select atau manual
                    if ($request->filled('ring_gauge_select') && $request->ring_gauge_select !== '') {
                        $alatStandarItems[] = $alat . ' ' . $request->ring_gauge_select . ' mm ';
                    } elseif ($request->filled('ring_gauge_manual') && !empty(trim($request->ring_gauge_manual))) {
                        $alatStandarItems[] = $alat . ' ' . trim($request->ring_gauge_manual) . ' mm';
                    } else {
                        $alatStandarItems[] = $alat . ' (tidak ada ukuran)';
                    }
                    break;
                    
                default:
                    $alatStandarItems[] = $alat;
            }
        }
        
        $alatStandarString = !empty($alatStandarItems) ? implode(', ', $alatStandarItems) : '';
        
        \Log::info('🔧 Alat standar with measurements:', [
            'alat_standar_array' => $alatStandarArray,
            'gauge_block' => $request->gauge_block,
            'ring_gauge_select' => $request->ring_gauge_select,
            'ring_gauge_manual' => $request->ring_gauge_manual,
            'alat_standar_string' => $alatStandarString
        ]);

        // 2. SENSOR TYPE HANDLING
        $sensorType = $request->sensor_type ?? null;
        $sensorValue = null;
        $sensor = null;
        
        switch ($sensorType) {
            case 't_probe':
                $sensorValue = $request->t_probe_value ?? null;
                $sensor = 'T-Probe: ' . $sensorValue;
                break;
            case 'hanging_wire':
                $sensorValue = $request->hanging_wire_value ?? null;
                $sensor = 'Hanging Wire: ' . $sensorValue;
                break;
            case 'wire_holder':
                $sensorValue = $request->wire_holder_value ?? null;
                $sensor = 'Wire (Holder): ' . $sensorValue;
                break;
            case 'ball':
                $sensorValue = $request->ball_value ?? null;
                $sensor = 'Ball: ' . $sensorValue;
                break;
            default:
                $sensor = null;
        }

        // 3. HANDLE SUDUT ULIR
        $sudutUlir = null;
        $sudutUlirType = $request->sudut_ulir_type ?? null;
        
        switch ($sudutUlirType) {
            case 'metrik':
                $sudutUlir = '60° (Ulir Metrik)';
                break;
            case 'non_metrik':
                $sudutUlir = '55° (Ulir Non Metrik)';
                break;
            case 'lainnya':
                $sudutUlirValue = $request->sudut_ulir_lainnya ?? null;
                $sudutUlir = $sudutUlirValue ? $sudutUlirValue . '' : null;
                break;
            default:
                $sudutUlir = null;
        }

        // 4. CATATAN
        $catatan = $request->catatan ?? null;

        // 5. CALIBRATED BY & VERIFIED BY
        $calibratedBy = $request->calibrated_by ?? null;
        $verifiedBy = $request->verified_by ?? null;

        \Log::info('📏 Thread Gauge Complete Data:', [
            'alat_standar' => $alatStandarString,
            'sensor_type' => $sensorType,
            'sensor_value' => $sensorValue,
            'sudut_ulir_type' => $sudutUlirType,
            'sudut_ulir' => $sudutUlir,
            'catatan' => substr($catatan, 0, 100) . (strlen($catatan) > 100 ? '...' : ''),
            'calibrated_by' => $calibratedBy,
            'verified_by' => $verifiedBy
        ]);

        // 6. SIMPAN KE HEAD THREAD GAUGE
        $head = HeadThreadGauge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString, // INI SUDAH TERMASUK UKURAN
            'calibrationMethod' => 'PAS-IK1102-64',
            'catatan' => $catatan,
            // Note: Jika perlu field calibrated_by dan verified_by, tambahkan ke migration
        ]);

        \Log::info('✅ Head Thread Gauge saved:', ['head_id' => $head->id]);

        // 7. SIMPAN DETAIL THREAD GAUGE
        \Log::info('📊 Saving Thread Gauge detail measurements...');
        
        // Cek apakah ada data yang perlu disimpan
        $hasGoData = $request->filled('nilai_nominal_go') || 
                     $request->filled('go_atas_x') || 
                     $request->filled('go_atas_y') ||
                     $request->filled('go_bawah_x') ||
                     $request->filled('go_bawah_y');
        
        $hasNotGoData = $request->filled('nilai_nominal_not_go') || 
                        $request->filled('not_go_atas_x') || 
                        $request->filled('not_go_atas_y') ||
                        $request->filled('not_go_bawah_x') ||
                        $request->filled('not_go_bawah_y');
        
        // Simpan detail jika ada data
        if ($hasGoData || $hasNotGoData || $sensor || $request->filled('ukuran_pitch')) {
            $detailData = [
                'calibration_id' => $calibration->id,
                
                // Sensor Data
                'sensor' => $sensor,
                
                // GO Data
                'kodeGO' => $request->kode_go ?? null,
                'satuan_go' => $request->satuan_go ?? null,
                'nominalGO' => $this->parseDecimal($request->nilai_nominal_go),
                'GOatasX1' => $this->parseDecimal($request->go_atas_x),
                'GOatasY1' => $this->parseDecimal($request->go_atas_y),
                'GObawahX1' => $this->parseDecimal($request->go_bawah_x),
                'GObawahY1' => $this->parseDecimal($request->go_bawah_y),
                
                // NOT GO Data
                'kodeNOTGO' => $request->kode_not_go ?? null,
                'satuan_not_go' => $request->satuan_not_go ?? null,
                'nominalNOTGO' => $this->parseDecimal($request->nilai_nominal_not_go),
                'NOTGOatasX1' => $this->parseDecimal($request->not_go_atas_x),
                'NOTGOatasY1' => $this->parseDecimal($request->not_go_atas_y),
                'NOTGObawahX1' => $this->parseDecimal($request->not_go_bawah_x),
                'NOTGObawahY1' => $this->parseDecimal($request->not_go_bawah_y),
                
                // Pitch dan Sudut Ulir
                'ukuranPitch' => $this->parseDecimal($request->ukuran_pitch),
                'satuan_pitch' => $request->satuan_pitch ?? null,
                'sudutUlir' => $sudutUlir,
            ];

            // Log data yang akan disimpan
            \Log::info('📝 Thread Gauge detail data to save:', array_filter($detailData, function($value) {
                return $value !== null;
            }));
            
            $detail = DetailThreadGauge::create($detailData);
            \Log::info('✅ Detail Thread Gauge saved:', ['detail_id' => $detail->id]);
            
            $detailCount = 1;
        } else {
            \Log::info('ℹ️ No detail data to save for Thread Gauge');
            $detailCount = 0;
        }

        \Log::info("✅ Saved $detailCount Thread Gauge detail measurements");

        return $head;

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Thread Gauge data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

// Helper function untuk parsing decimal
private function parseDecimal($value)
{
    if (empty($value) || trim($value) === '') {
        return null;
    }
    
    // Hapus karakter non-numerik kecuali titik dan minus
    $value = preg_replace('/[^0-9\.\-]/', '', $value);
    
    if ($value === '' || $value === null) {
        return null;
    }
    
    return (float) $value;
}


private function storeStopwatch($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar stopwatch:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head Stopwatch
        $head = HeadStopwatch::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-45',
            'catatan' => $request->catatan ?? null,
        ]);

        \Log::info('✅ Head Stopwatch saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - 10 TITIK UKUR (Standar + Alat per titik)
        \Log::info('📊 Saving stopwatch measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 10; $i++) { // UBAH DARI 8 MENJADI 10
            // Cek apakah ada data untuk titik ukur ini
            $hasData = false;
            
            // Cek data STANDAR untuk titik ukur ini
            for ($p = 1; $p <= 5; $p++) {
                // Cek apakah ada data menit, second, atau milisecond
                if ($request->has("standar_{$i}_p{$p}_menit") && !empty(trim($request->{"standar_{$i}_p{$p}_menit"}))) {
                    $hasData = true;
                    break;
                }
                if ($request->has("standar_{$i}_p{$p}_second") && !empty(trim($request->{"standar_{$i}_p{$p}_second"}))) {
                    $hasData = true;
                    break;
                }
                if ($request->has("standar_{$i}_p{$p}_milisecond") && !empty(trim($request->{"standar_{$i}_p{$p}_milisecond"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Cek data ALAT (UUT) untuk titik ukur ini
            if (!$hasData) {
                for ($p = 1; $p <= 5; $p++) {
                    if ($request->has("alat_{$i}_p{$p}_menit") && !empty(trim($request->{"alat_{$i}_p{$p}_menit"}))) {
                        $hasData = true;
                        break;
                    }
                    if ($request->has("alat_{$i}_p{$p}_second") && !empty(trim($request->{"alat_{$i}_p{$p}_second"}))) {
                        $hasData = true;
                        break;
                    }
                    if ($request->has("alat_{$i}_p{$p}_milisecond") && !empty(trim($request->{"alat_{$i}_p{$p}_milisecond"}))) {
                        $hasData = true;
                        break;
                    }
                }
            }
            
            // Simpan jika ada titik ukur atau data pengukuran
            if (($request->has("titik_ukur_{$i}") && !empty(trim($request->{"titik_ukur_{$i}"}))) || $hasData) {
                
                // Persiapkan data detail
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'head_stopwatch_id' => $head->id,
                    'titikUkur' => $request->{"titik_ukur_{$i}"} ?? null,
                ];
                
                // Mapping data STANDAR untuk 5 pengulangan
                $detailData["STDm1"] = $request->{"standar_{$i}_p1_menit"} ?? null;
                $detailData["STDs1"] = $request->{"standar_{$i}_p1_second"} ?? null;
                $detailData["STDms1"] = $request->{"standar_{$i}_p1_milisecond"} ?? null;
                
                $detailData["STDm2"] = $request->{"standar_{$i}_p2_menit"} ?? null;
                $detailData["STDs2"] = $request->{"standar_{$i}_p2_second"} ?? null;
                $detailData["STDms2"] = $request->{"standar_{$i}_p2_milisecond"} ?? null;
                
                $detailData["STDm3"] = $request->{"standar_{$i}_p3_menit"} ?? null;
                $detailData["STDs3"] = $request->{"standar_{$i}_p3_second"} ?? null;
                $detailData["STDms3"] = $request->{"standar_{$i}_p3_milisecond"} ?? null;
                
                $detailData["STDm4"] = $request->{"standar_{$i}_p4_menit"} ?? null;
                $detailData["STDs4"] = $request->{"standar_{$i}_p4_second"} ?? null;
                $detailData["STDms4"] = $request->{"standar_{$i}_p4_milisecond"} ?? null;
                
                $detailData["STDm5"] = $request->{"standar_{$i}_p5_menit"} ?? null;
                $detailData["STDs5"] = $request->{"standar_{$i}_p5_second"} ?? null;
                $detailData["STDms5"] = $request->{"standar_{$i}_p5_milisecond"} ?? null;
                
                // Mapping data ALAT (UUT) untuk 5 pengulangan
                $detailData["UUTm1"] = $request->{"alat_{$i}_p1_menit"} ?? null;
                $detailData["UUTs1"] = $request->{"alat_{$i}_p1_second"} ?? null;
                $detailData["UUTms1"] = $request->{"alat_{$i}_p1_milisecond"} ?? null;
                
                $detailData["UUTm2"] = $request->{"alat_{$i}_p2_menit"} ?? null;
                $detailData["UUTs2"] = $request->{"alat_{$i}_p2_second"} ?? null;
                $detailData["UUTms2"] = $request->{"alat_{$i}_p2_milisecond"} ?? null;
                
                $detailData["UUTm3"] = $request->{"alat_{$i}_p3_menit"} ?? null;
                $detailData["UUTs3"] = $request->{"alat_{$i}_p3_second"} ?? null;
                $detailData["UUTms3"] = $request->{"alat_{$i}_p3_milisecond"} ?? null;
                
                $detailData["UUTm4"] = $request->{"alat_{$i}_p4_menit"} ?? null;
                $detailData["UUTs4"] = $request->{"alat_{$i}_p4_second"} ?? null;
                $detailData["UUTms4"] = $request->{"alat_{$i}_p4_milisecond"} ?? null;
                
                $detailData["UUTm5"] = $request->{"alat_{$i}_p5_menit"} ?? null;
                $detailData["UUTs5"] = $request->{"alat_{$i}_p5_second"} ?? null;
                $detailData["UUTms5"] = $request->{"alat_{$i}_p5_milisecond"} ?? null;

                \Log::info("📝 Saving stopwatch detail row $i:", [
                    'titik_ukur' => $detailData['titikUkur'],
                    'std_p1_menit' => $detailData['STDm1'],
                    'uut_p1_menit' => $detailData['UUTm1']
                ]);
                
                DetailStopwatch::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount stopwatch detail measurements");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Stopwatch data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
        throw $e;
    }
}


private function storeCentrifuge($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar centrifuge selected:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head Centrifuge
        $head = HeadCentrifuge::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-52', // Sesuai input metode kalibrasi
        ]);

        \Log::info('✅ Head Centrifuge saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - 12 BARIS (sesuai tabel)
        \Log::info('📊 Saving centrifuge detail measurements...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 12; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada pembacaan standar yang diisi (minimal satu)
            for ($j = 1; $j <= 5; $j++) {
                if ($request->has("std_{$i}_{$j}") && !empty(trim($request->{"std_{$i}_{$j}"}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data setpoint atau pembacaan standar
            if (($request->has("setpoint_$i") && !empty(trim($request->{"setpoint_$i"}))) || $hasData) {
                
                // Ambil resolusi alat untuk baris ini
                $resolusiAlat = $request->has("resolusi_alat") && !empty(trim($request->{"resolusi_alat"})) 
                    ? $request->{"resolusi_alat"} 
                    : null;

                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nominalRPM' => $request->{"setpoint_$i"} ?? null,
                    'STD1' => $request->{"std_{$i}_1"} ?? null,
                    'STD2' => $request->{"std_{$i}_2"} ?? null,
                    'STD3' => $request->{"std_{$i}_3"} ?? null,
                    'STD4' => $request->{"std_{$i}_4"} ?? null,
                    'STD5' => $request->{"std_{$i}_5"} ?? null,
                    'resolusi' => $resolusiAlat,
                ];

                \Log::info("📝 Saving centrifuge detail row $i:", $detailData);
                
                DetailCentrifuge::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount centrifuge detail measurements");

        // Simpan informasi tanda tangan jika ada
        $signatureData = [];
        
        if ($request->has('calibrated_by') && !empty(trim($request->calibrated_by))) {
            $signatureData['calibrated_by'] = $request->calibrated_by;
            \Log::info('📝 Calibrated by:', ['name' => $request->calibrated_by]);
        }
        
        if ($request->has('verified_by') && !empty(trim($request->verified_by))) {
            $signatureData['verified_by'] = $request->verified_by;
            \Log::info('📝 Verified by:', ['name' => $request->verified_by]);
        }
        
        // Jika ada data tanda tangan, update head atau simpan ke tabel lain
        if (!empty($signatureData)) {
            // Anda bisa menyimpan ke head atau tabel khusus untuk tanda tangan
            // Contoh: $head->update($signatureData);
            \Log::info('✅ Signature data captured:', $signatureData);
        }

        return $head;

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Centrifuge data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

private function storeUtm($request, $calibration, $certificateId)
{
    try {
        // Handle alat_standar yang berupa array (radio button)
        $alatStandar = $request->alat_standar_text;
        $alatStandarString = '';
        
        if (is_array($alatStandar)) {
            // Jika berupa array, ambil nilai pertama
            $alatStandarString = !empty($alatStandar) ? $alatStandar[0] : '';
        } else {
            // Jika sudah string
            $alatStandarString = $alatStandar ?? '';
        }
        
        \Log::info('🔧 Alat standar UTM selected:', [
            'alat_standar_raw' => $alatStandar,
            'alat_standar_string' => $alatStandarString
        ]);

        // Simpan ke Head Utm
        $head = HeadUtm::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-54',
            'satuan_titik_ukur_tekan' => $request->satuan_titik_tekan ?? null,
            'satuan_read_tekan_std' => $request->satuan_tekan_standar ?? null,
            'satuan_read_tekan_uut' => $request->satuan_tekan_uut ?? null,
            'satuan_titik_ukur_tarik' => $request->satuan_titik_tarik ?? null,
            'satuan_read_tarik_std' => $request->satuan_tarik_standar ?? null,
            'satuan_read_tarik_uut' => $request->satuan_tarik_uut ?? null,
        ]);

        \Log::info('✅ Head Utm saved:', ['head_id' => $head->id]);

        // Simpan detail measurements untuk TEKAN - 8 BARIS
        \Log::info('📊 Saving UTM TEKAN detail measurements...');
        $detailCountTekan = 0;
        
        for ($i = 1; $i <= 8; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada data yang diisi (titik ukur atau minimal satu pembacaan)
            $titikUkur = $request->{"titik_ukur_tekan_$i"} ?? null;
            $std1 = $request->{"tekan_standar_{$i}_0_1"} ?? null;
            $std2 = $request->{"tekan_standar_{$i}_120_2"} ?? null;
            $std3 = $request->{"tekan_standar_{$i}_240_3"} ?? null;
            $uut1 = $request->{"tekan_uut_{$i}_0_1"} ?? null;
            $uut2 = $request->{"tekan_uut_{$i}_120_2"} ?? null;
            $uut3 = $request->{"tekan_uut_{$i}_240_3"} ?? null;
            
            // Cek jika ada nilai yang tidak kosong
            if (!empty(trim($titikUkur ?? '')) || 
                !empty(trim($std1 ?? '')) || 
                !empty(trim($std2 ?? '')) || 
                !empty(trim($std3 ?? '')) || 
                !empty(trim($uut1 ?? '')) || 
                !empty(trim($uut2 ?? '')) || 
                !empty(trim($uut3 ?? ''))) {
                $hasData = true;
            }
            
            // Simpan jika ada data
            if ($hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $titikUkur,
                    'readTekanSTD1' => $std1,
                    'readTekanSTD2' => $std2,
                    'readTekanSTD3' => $std3,
                    'readTekanUUT1' => $uut1,
                    'readTekanUUT2' => $uut2,
                    'readTekanUUT3' => $uut3,
                    // Kolom tarik dikosongkan untuk data tekan
                    'readTarikSTD1' => null,
                    'readTarikSTD2' => null,
                    'readTarikSTD3' => null,
                    'readTarikUUT1' => null,
                    'readTarikUUT2' => null,
                    'readTarikUUT3' => null,
                ];

                \Log::info("📝 Saving TEKAN detail row $i:", $detailData);
                
                DetailUtm::create($detailData);
                $detailCountTekan++;
            }
        }
        
        \Log::info("✅ Saved $detailCountTekan TEKAN detail measurements");

        // Simpan detail measurements untuk TARIK - 8 BARIS
        \Log::info('📊 Saving UTM TARIK detail measurements...');
        $detailCountTarik = 0;
        
        for ($i = 1; $i <= 8; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek apakah ada data yang diisi (titik ukur atau minimal satu pembacaan)
            $titikUkur = $request->{"titik_ukur_tarik_$i"} ?? null;
            $std1 = $request->{"tarik_standar_{$i}_0_1"} ?? null;
            $std2 = $request->{"tarik_standar_{$i}_120_2"} ?? null;
            $std3 = $request->{"tarik_standar_{$i}_240_3"} ?? null;
            $uut1 = $request->{"tarik_uut_{$i}_0_1"} ?? null;
            $uut2 = $request->{"tarik_uut_{$i}_120_2"} ?? null;
            $uut3 = $request->{"tarik_uut_{$i}_240_3"} ?? null;
            
            // Cek jika ada nilai yang tidak kosong
            if (!empty(trim($titikUkur ?? '')) || 
                !empty(trim($std1 ?? '')) || 
                !empty(trim($std2 ?? '')) || 
                !empty(trim($std3 ?? '')) || 
                !empty(trim($uut1 ?? '')) || 
                !empty(trim($uut2 ?? '')) || 
                !empty(trim($uut3 ?? ''))) {
                $hasData = true;
            }
            
            // Simpan jika ada data
            if ($hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'titikUkur' => $titikUkur,
                    // Kolom tekan dikosongkan untuk data tarik
                    'readTekanSTD1' => null,
                    'readTekanSTD2' => null,
                    'readTekanSTD3' => null,
                    'readTekanUUT1' => null,
                    'readTekanUUT2' => null,
                    'readTekanUUT3' => null,
                    'readTarikSTD1' => $std1,
                    'readTarikSTD2' => $std2,
                    'readTarikSTD3' => $std3,
                    'readTarikUUT1' => $uut1,
                    'readTarikUUT2' => $uut2,
                    'readTarikUUT3' => $uut3,
                ];

                \Log::info("📝 Saving TARIK detail row $i:", $detailData);
                
                DetailUtm::create($detailData);
                $detailCountTarik++;
            }
        }
        
        \Log::info("✅ Saved $detailCountTarik TARIK detail measurements");
        
        \Log::info("📊 Total UTM measurements saved: {$detailCountTekan} TEKAN + {$detailCountTarik} TARIK = " . ($detailCountTekan + $detailCountTarik));

        // Simpan informasi tanda tangan (jika ada field di model HeadUtm)
        $signatureData = [];
        
        if ($request->has('calibrated_by') && !empty(trim($request->calibrated_by))) {
            $signatureData['calibrated_by'] = $request->calibrated_by;
            \Log::info('📝 Calibrated by:', ['name' => $request->calibrated_by]);
        }
        
        if ($request->has('verified_by') && !empty(trim($request->verified_by))) {
            $signatureData['verified_by'] = $request->verified_by;
            \Log::info('📝 Verified by:', ['name' => $request->verified_by]);
        }
        
        // Jika ingin menyimpan tanda tangan di head, perlu tambah field di model
        if (!empty($signatureData)) {
            \Log::info('✅ Signature data captured:', $signatureData);
        }

        return $head;

    } catch (\Exception $e) {
        \Log::error('💥 Error storing UTM data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}


private function storeAnakTimbangan($request, $calibration, $certificateId)
{
    try {
        \Log::info('🔧 Starting storeAnakTimbangan function...');
        
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head Anak Timbangan
        $head = HeadAnakTimbangan::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'satuan_unit01' => $request->satuan_unit01 ?? '',
            'satuan_unit02' => $request->satuan_unit02 ?? '',
            'calibrationMethod' => 'PAS-IK1102-16',
        ]);

        \Log::info('✅ Head Anak Timbangan saved:', ['head_id' => $head->id]);

        // Simpan detail measurements - 5 NOMOR
        \Log::info('📊 Saving detail measurements for Anak Timbangan...');
        $detailCount = 0;
        
        for ($i = 1; $i <= 5; $i++) {
            // Cek apakah ada data untuk nomor ini
            $hasData = false;
            
            // Cek massa nominal
            $massaNominal = $request->input("massa_nominal_$i");
            if (!empty($massaNominal) && trim($massaNominal) !== '') {
                $hasData = true;
            }
            
            // Cek AT Standard
            $atStandard = $request->input("at_standard_$i");
            if (!empty($atStandard) && trim($atStandard) !== '') {
                $hasData = true;
            }
            
            // Cek minimal satu nilai input untuk konfirmasi ada data
            if (!$hasData) {
                // Cek salah satu dari 8 input values
                $checks = [
                    "unit01_s_{$i}_1",
                    "unit02_s_{$i}_1",
                    "unit01_t_{$i}_1",
                    "unit02_t_{$i}_1",
                    "unit01_t_{$i}_2",
                    "unit02_t_{$i}_2",
                    "unit01_s_{$i}_2",
                    "unit02_s_{$i}_2"
                ];
                
                foreach ($checks as $check) {
                    $value = $request->input($check);
                    if (!empty($value) && trim($value) !== '') {
                        $hasData = true;
                        break;
                    }
                }
            }
            
            // Simpan jika ada data
            if ($hasData) {
                // Bersihkan dan format data
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'nominalAlat' => $massaNominal ?? '',
                    'ATSTD' => $atStandard ?? '',
                    
                    // Baris 1: S - S (Upper Left/Right STD)
                    'ULSTD' => $this->cleanNumericValue($request->input("unit01_s_{$i}_1")),
                    'URSTD' => $this->cleanNumericValue($request->input("unit02_s_{$i}_1")),
                    
                    // Baris 2: T - T (Upper Left/Right UUT)
                    'ULUUT' => $this->cleanNumericValue($request->input("unit01_t_{$i}_1")),
                    'URUUT' => $this->cleanNumericValue($request->input("unit02_t_{$i}_1")),
                    
                    // Baris 3: T - T (Lower Left/Right UUT)
                    'LLUUT' => $this->cleanNumericValue($request->input("unit01_t_{$i}_2")),
                    'LRUUT' => $this->cleanNumericValue($request->input("unit02_t_{$i}_2")),
                    
                    // Baris 4: S - S (Lower Left/Right STD)
                    'LLSTD' => $this->cleanNumericValue($request->input("unit01_s_{$i}_2")),
                    'LRSTD' => $this->cleanNumericValue($request->input("unit02_s_{$i}_2")),
                ];
                
                \Log::info("📝 Saving Anak Timbangan - Nomor $i:", $detailData);
                
                DetailAnakTimbangan::create($detailData);
                $detailCount++;
                
            } else {
                \Log::info("⚠️ Skipping Nomor $i - No data found");
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements for Anak Timbangan");

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Anak Timbangan data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}

/**
 * Helper function untuk membersihkan nilai numerik
 */
private function cleanNumericValue($value)
{
    if (empty($value) || trim($value) === '') {
        return null;
    }
    
    // Hapus spasi dan karakter non-numerik kecuali titik dan minus
    $cleaned = preg_replace('/[^\d\.\-]/', '', $value);
    
    // Cek jika kosong setelah dibersihkan
    if ($cleaned === '' || $cleaned === '-') {
        return null;
    }
    
    return $cleaned;
}

private function storePressureTransmitter($request, $calibration, $certificateId)
{
    try {
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::info('🔧 Alat standar selected for Pressure Transmitter:', ['alat_standar' => $alatStandar]);

        // Simpan ke Head Pressure Transmitter
        $head = HeadPressureTransmitter::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandarString,
            'calibrationMethod' => 'PAS-IK1102-55',
            'satuan_set_point' => $request->satuan_set_point ?? null,
            'satuan_p_naik' => $request->satuan_p_naik ?? null,
            'satuan_so_naik' => $request->satuan_signal_naik ?? null,
            'satuan_p_turun' => $request->satuan_p_turun ?? null,
            'satuan_so_turun' => $request->satuan_signal_turun ?? null,
            'tertelusur' => $request->tertelusur ?? null,
        ]);

        \Log::info('✅ Head Pressure Transmitter saved:', ['head_id' => $head->id]);

        // Simpan detail measurements (setPoint dan readings)
        \Log::info('📊 Saving pressure transmitter detail measurements...');
        $detailCount = 0;
        
        // Loop untuk 11 titik pengukuran (sesuai HTML)
        for ($i = 1; $i <= 11; $i++) {
            // Cek apakah ada data untuk baris ini
            $hasData = false;
            
            // Cek field-field yang mungkin ada datanya
            $fieldsToCheck = [
                "set_point_$i",
                "pembacaan_naik_$i",
                "signal_naik_$i",
                "pembacaan_turun_$i",
                "signal_turun_$i"
            ];
            
            foreach ($fieldsToCheck as $field) {
                if ($request->has($field) && !empty(trim($request->{$field}))) {
                    $hasData = true;
                    break;
                }
            }
            
            // Simpan jika ada data
            if ($hasData) {
                
                $detailData = [
                    'calibration_id' => $calibration->id,
                    'head_pressure_transmitter_id' => $head->id,
                    'setPoint' => $request->{"set_point_$i"} ?? null,
                    'readP_UP' => $request->{"pembacaan_naik_$i"} ?? null,    // Map ke readP_UP
                    'readS_UP' => $request->{"signal_naik_$i"} ?? null,      // Map ke readS_UP
                    'readP_DOWN' => $request->{"pembacaan_turun_$i"} ?? null, // Map ke readP_DOWN
                    'readS_DOWN' => $request->{"signal_turun_$i"} ?? null,   // Map ke readS_DOWN
                ];

                \Log::info("📝 Saving pressure transmitter detail row $i:", $detailData);
                
                DetailPressureTransmitter::create($detailData);
                $detailCount++;
            }
        }
        
        \Log::info("✅ Saved $detailCount detail measurements");

        // Simpan data satuan dari tabel utama (jika ada)
        $mainSatuan = [];
        if ($request->has('satuan_set_point') && !empty(trim($request->satuan_set_point))) {
            $mainSatuan['satuan_set_point'] = $request->satuan_set_point;
        }
        if ($request->has('satuan_naik') && !empty(trim($request->satuan_naik))) {
            $mainSatuan['satuan_naik'] = $request->satuan_naik;
        }
        if ($request->has('satuan_signal_naik') && !empty(trim($request->satuan_signal_naik))) {
            $mainSatuan['satuan_signal_naik'] = $request->satuan_signal_naik;
        }
        if ($request->has('satuan_turun') && !empty(trim($request->satuan_turun))) {
            $mainSatuan['satuan_turun'] = $request->satuan_turun;
        }
        if ($request->has('satuan_signal_turun') && !empty(trim($request->satuan_signal_turun))) {
            $mainSatuan['satuan_signal_turun'] = $request->satuan_signal_turun;
        }
        
        if (!empty($mainSatuan)) {
            \Log::info('💾 Main table satuan data:', $mainSatuan);
            // Anda bisa menyimpan ini ke tabel AddPressureTransmitter atau tempat lain
        }

        // Simpan data tambahan (AddPressureTransmitter)
        \Log::info('💾 Checking for additional pressure transmitter data...');
        
        // Cek apakah ada data untuk disimpan
        $hasAdditionalData = false;
        
        // Cek field-field utama
        $mainFields = ['repeatability_p', 'satuan_p', 'repeatibility_SO', 'satuan_SO'];
        foreach ($mainFields as $field) {
            if ($request->has($field) && !empty(trim($request->{$field}))) {
                $hasAdditionalData = true;
                break;
            }
        }
        
        // Cek data repeatability pressure (repP01-repP10)
        for ($i = 1; $i <= 10; $i++) {
            $fieldName = 'repP' . sprintf('%02d', $i);
            if ($request->has($fieldName) && !empty(trim($request->{$fieldName}))) {
                $hasAdditionalData = true;
                break;
            }
        }
        
        // Cek data repeatability signal output (repSO01-repSO10)
        for ($i = 1; $i <= 10; $i++) {
            $fieldName = 'repSO' . sprintf('%02d', $i);
            if ($request->has($fieldName) && !empty(trim($request->{$fieldName}))) {
                $hasAdditionalData = true;
                break;
            }
        }

        if ($hasAdditionalData) {
            // Data utama
            $additionalData = [
                'calibration_id' => $calibration->id,
                'satuan_P' => $request->satuan_p ?? null,
                'repeatibility_P' => $request->repeatability_p ?? null, // Perhatikan: HTML 'repeatability_p', DB 'repeatibility_P'
                'satuan_SO' => $request->satuan_SO ?? null,
                'repeatibility_SO' => $request->repeatibility_SO ?? null,
            ];

            // Tambahkan data repeatability untuk Pressure (repP01-repP10)
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = 'repP' . sprintf('%02d', $i); // Format: repP01, repP02, ..., repP10
                $additionalData[$fieldName] = $request->{$fieldName} ?? null;
            }

            // Tambahkan data repeatability untuk Signal Output (repSO01-repSO10)
            for ($i = 1; $i <= 10; $i++) {
                $fieldName = 'repSO' . sprintf('%02d', $i); // Format: repSO01, repSO02, ..., repSO10
                $additionalData[$fieldName] = $request->{$fieldName} ?? null;
            }

            // Tambahkan data satuan dari tabel utama jika ada
            $additionalData = array_merge($additionalData, $mainSatuan);

            \Log::info('💾 Saving additional pressure transmitter data:', $additionalData);
            
            AddPressureTransmitter::create($additionalData);
            \Log::info('✅ Additional pressure transmitter data saved');
        } else {
            \Log::info('ℹ️ No additional pressure transmitter data to save');
        }

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Pressure Transmitter data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);
        throw $e;
    }
}


private function storeSurfacePlate($request, $calibration, $certificateId)
{
    try {
        \Log::info('🎯 Starting storeSurfacePlate function');
        
        // ============================================
        // DEBUG: Log semua field penting dari request
        // ============================================
        \Log::info('🔍 DEBUG IMPORTANT REQUEST KEYS:');
        
        // 1. Cek field tabel utama (a1_1 sampai a10_4)
        $mainTableKeys = [];
        for ($row = 1; $row <= 10; $row++) {
            for ($col = 1; $col <= 4; $col++) {
                $key = "a{$row}_{$col}";
                if ($request->has($key)) {
                    $value = $request->$key;
                    $mainTableKeys[$key] = $value;
                    \Log::info("   MAIN TABLE - {$key}: " . ($value !== null && $value !== '' ? "'{$value}'" : 'EMPTY'));
                }
            }
        }
        
        // 2. Cek field keterangan (canvas)
        $keteranganValue = $request->input('keterangan');
        \Log::info('🔍 KETERANGAN FIELD:');
        \Log::info('   Has keterangan: ' . ($request->has('keterangan') ? 'YES' : 'NO'));
        \Log::info('   Is base64 image: ' . ($keteranganValue && strpos($keteranganValue, 'data:image') === 0 ? 'YES' : 'NO'));
        \Log::info('   Length: ' . ($keteranganValue ? strlen($keteranganValue) : '0'));
        
        // 3. Cek field alat standar
        $alatStandar = $request->alat_standar_text ?? [];
        \Log::info('🔧 Alat standar:', ['alat_standar' => $alatStandar]);

        // ============================================
        // 1. SIMPAN GAMBAR CANVAS
        // ============================================
        $keteranganText = '';
        
        if ($keteranganValue && strpos($keteranganValue, 'data:image') === 0) {
            \Log::info('🖼️ Found canvas image data in keterangan field');
            $canvasImagePath = $this->saveCanvasImage($keteranganValue, $calibration->id);
            
            if ($canvasImagePath) {
                $keteranganText = $canvasImagePath;
                \Log::info('✅ Canvas image saved. Path: ' . $canvasImagePath);
            } else {
                $keteranganText = "";
                \Log::warning('⚠️ Failed to save canvas image');
            }
        } else {
            $keteranganText = $keteranganValue ?? '';
            \Log::info('📝 Using text keterangan: ' . substr($keteranganText, 0, 50));
        }

        // ============================================
        // 2. SIMPAN KE HEAD SURFACE PLATE
        // ============================================
        $head = HeadSurfacePlate::create([
            'calibration_id' => $calibration->id,
            'certificate_id' => $certificateId,
            'standard' => $alatStandar,
            'calibrationMethod' => 'PAS-IK1102-53',
            'keterangan' => $keteranganText,
        ]);

        \Log::info('✅ Head Surface Plate saved:', ['head_id' => $head->id]);

        // ============================================
        // 3. SIMPAN DETAIL MEASUREMENTS
        // ============================================
        \Log::info('📊 Saving ALL detail measurements for Surface Plate...');
        
        $detailData = [
            'calibration_id' => $calibration->id,
        ];

        // ============================================
        // 3A. DATA TABEL UTAMA (a1_1 sampai a10_4) - INI YANG TIDAK KESAVE
        // ============================================
        \Log::info('📋 Processing MAIN TABLE data (a1_1 to a10_4)...');
        $mainTableCount = 0;
        
        for ($row = 1; $row <= 10; $row++) {
            for ($col = 1; $col <= 4; $col++) {
                $key = "a{$row}_{$col}";
                $value = $this->cleanNumericValue($request->$key ?? null);
                
                // Langsung simpan ke database field dengan nama yang sama
                $detailData[$key] = $value;
                
                if ($value !== null) {
                    $mainTableCount++;
                    \Log::debug("   MAIN - {$key} = {$value}");
                }
            }
        }
        
        \Log::info("✅ MAIN TABLE: {$mainTableCount} values saved");

        // ============================================
        // 3B. DATA TABEL 1 (Kelompok A) - dari repeatability matrix
        // ============================================
        \Log::info('📋 Processing Table 1 (Group A) from repeatability matrix...');
        $table1Count = 0;
        
        for ($i = 1; $i <= 9; $i++) {
            $key1 = "a{$i}_1";      // a1_1, a2_1, ..., a9_1
            $key2 = "a{$i}_2";      // a1_2, a2_2, ..., a9_2
            
            $value1 = $this->cleanNumericValue($request->$key1 ?? null);
            $value2 = $this->cleanNumericValue($request->$key2 ?? null);
            
            $detailData["a{$i}_1_tbl1"] = $value1;
            $detailData["a{$i}_2_tbl1"] = $value2;
            
            if ($value1 !== null) {
                $table1Count++;
                \Log::debug("   TABLE 1 - {$key1} -> a{$i}_1_tbl1 = {$value1}");
            }
            if ($value2 !== null) {
                $table1Count++;
                \Log::debug("   TABLE 1 - {$key2} -> a{$i}_2_tbl1 = {$value2}");
            }
        }
        
        \Log::info("✅ TABLE 1: {$table1Count} values saved");

        // ============================================
        // 3C. DATA TABEL 2-10 (Kelompok B-J)
        // ============================================
        \Log::info('📋 Processing Tables 2-10 (Groups B-J)...');
        
        $groups = [
            2 => ['letter' => 'b', 'rows' => 9],
            3 => ['letter' => 'c', 'rows' => 9],
            4 => ['letter' => 'd', 'rows' => 9],
            5 => ['letter' => 'e', 'rows' => 9],
            6 => ['letter' => 'f', 'rows' => 9],
            7 => ['letter' => 'g', 'rows' => 9],
            8 => ['letter' => 'h', 'rows' => 9],
            9 => ['letter' => 'i', 'rows' => 9],
            10 => ['letter' => 'j', 'rows' => 9],
        ];
        
        $tables2to10Count = 0;
        
        foreach ($groups as $tableNum => $config) {
            $letter = $config['letter'];
            $rows = $config['rows'];
            
            $tableDataCount = 0;
            
            for ($row = 1; $row <= $rows; $row++) {
                $inputKey1 = "{$letter}_{$row}_1";
                $inputKey2 = "{$letter}_{$row}_2";
                
                if ($row == 1) {
                    $dbKey1 = "a1_1_tbl{$tableNum}";
                    $dbKey2 = "a1_2_tbl{$tableNum}";
                } else {
                    $dbRow = $row - 1;
                    $dbKey1 = "{$letter}{$dbRow}_1_tbl{$tableNum}";
                    $dbKey2 = "{$letter}{$dbRow}_2_tbl{$tableNum}";
                }
                
                $value1 = $this->cleanNumericValue($request->$inputKey1 ?? null);
                $value2 = $this->cleanNumericValue($request->$inputKey2 ?? null);
                
                $detailData[$dbKey1] = $value1;
                $detailData[$dbKey2] = $value2;
                
                if ($value1 !== null) {
                    $tableDataCount++;
                    $tables2to10Count++;
                }
                if ($value2 !== null) {
                    $tableDataCount++;
                    $tables2to10Count++;
                }
            }
            
            \Log::debug("   TABLE {$tableNum}: {$tableDataCount} values");
        }
        
        \Log::info("✅ TABLES 2-10: {$tables2to10Count} values saved");

        // ============================================
        // 4. SIMPAN KE DATABASE
        // ============================================
        \Log::info('📝 Final data summary:');
        \Log::info("   - Main table (a1_1...a10_4): {$mainTableCount} values");
        \Log::info("   - Table 1: {$table1Count} values");
        \Log::info("   - Tables 2-10: {$tables2to10Count} values");
        \Log::info('   - Total fields in detailData: ' . count($detailData));
        
        // Hitung total non-null values
        $nonNullTotal = 0;
        foreach ($detailData as $value) {
            if ($value !== null) {
                $nonNullTotal++;
            }
        }
        \Log::info("   - Total non-null values: {$nonNullTotal}");
        
        // Simpan ke database
        $detail = DetailSurfacePlate::create($detailData);
        
        \Log::info('✅ ALL data saved successfully!');
        \Log::info('📊 Detail record ID: ' . $detail->id);

        // ============================================
        // 5. VERIFIKASI FINAL
        // ============================================
        \Log::info('🔍 FINAL VERIFICATION...');
        
        $savedDetail = DetailSurfacePlate::find($detail->id);
        
        // Cek data utama (a1_1 sampai a10_4)
        $mainTableSavedCount = 0;
        for ($row = 1; $row <= 10; $row++) {
            for ($col = 1; $col <= 4; $col++) {
                $key = "a{$row}_{$col}";
                if (!is_null($savedDetail->$key)) {
                    $mainTableSavedCount++;
                }
            }
        }
        
        \Log::info("📊 Verification results:");
        \Log::info("   - Main table saved: {$mainTableSavedCount}/40 values");
        
        if ($mainTableSavedCount > 0) {
            \Log::info('✅ Main table data IS saved to database!');
        } else {
            \Log::error('❌ Main table data NOT saved to database!');
        }

        return $head;

    } catch (\Exception $e) {
        \Log::error('💥 Error storing Surface Plate data:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => substr($e->getTraceAsString(), 0, 500) // Batasi panjang trace
        ]);
        throw $e;
    }
}


/**
 * Simpan gambar canvas ke public/img_SurfacePlate
 * Kembalikan hanya path gambar (tanpa teks tambahan)
 */
private function saveCanvasImage($canvasData, $calibrationId)
{
    try {
        \Log::info('💾 Starting saveCanvasImage...');
        
        if (empty($canvasData) || !is_string($canvasData)) {
            \Log::warning('⚠️ Canvas data is empty or not string');
            return null;
        }
        
        \Log::info('📏 Canvas data length: ' . strlen($canvasData));
        
        // Validasi base64 image
        if (!preg_match('/^data:image\/(png|jpeg|jpg|gif);base64,/', $canvasData)) {
            \Log::warning('⚠️ Not a valid base64 image data. First 100 chars: ' . substr($canvasData, 0, 100));
            return null;
        }
        
        // Decode base64 image
        preg_match('/^data:image\/(\w+);base64,/', $canvasData, $matches);
        $type = strtolower($matches[1]);
        \Log::info('📸 Image type detected: ' . $type);
        
        $data = substr($canvasData, strpos($canvasData, ',') + 1);
        $decodedData = base64_decode($data, true);
        
        if ($decodedData === false) {
            \Log::error('❌ base64_decode failed');
            return null;
        }
        
        \Log::info('✅ Base64 decoded successfully, size: ' . strlen($decodedData) . ' bytes');
        
        // Generate filename yang lebih simple
        $filename = 'surface_plate_' . $calibrationId . '_' . time() . '.' . $type;
        
        // Pastikan folder exists
        $directory = public_path('img_SurfacePlate');
        if (!file_exists($directory)) {
            \Log::info('📁 Creating directory: ' . $directory);
            if (!mkdir($directory, 0755, true)) {
                \Log::error('❌ Failed to create directory: ' . $directory);
                return null;
            }
        }
        
        // Cek permission
        if (!is_writable($directory)) {
            \Log::error('❌ Directory not writable: ' . $directory);
            return null;
        }
        
        // Full path untuk disimpan
        $fullPath = $directory . '/' . $filename;
        
        // Save file
        $bytesWritten = file_put_contents($fullPath, $decodedData);
        
        if ($bytesWritten === false) {
            \Log::error('❌ Failed to write file to: ' . $fullPath);
            return null;
        }
        
        // Hanya kembalikan path relatif untuk web
        $webPath = 'img_SurfacePlate/' . $filename;
        
        \Log::info('🎉 Canvas image saved successfully!', [
            'filename' => $filename,
            'web_path' => $webPath,
            'size' => $this->formatBytes($bytesWritten)
        ]);
        
        return $webPath;
        
    } catch (\Exception $e) {
        \Log::error('💥 Error in saveCanvasImage:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return null;
    }
}





/**
 * Format bytes ke readable size
 */
private function formatBytes($bytes, $precision = 2)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    
    $bytes /= pow(1024, $pow);
    
    return round($bytes, $precision) . ' ' . $units[$pow];
}


    private function generateCertificateId($namaAlat)
    {
        try {
            // Gunakan count dari records yang ada + 1
            $count = Calibration::count() + 1;
            $formattedNumber = str_pad($count, 5, '0', STR_PAD_LEFT);
            $lastDigit = substr($count, -1);
            $currentYear = date('y');
            
            $certificateId = "PAS-({$formattedNumber})-K{$currentYear}-{$namaAlat}";

            // \Log::info('📄 Generated Certificate ID:', [
            //     'count' => $count,
            //     'certificate_id' => $certificateId
            // ]);

            return $certificateId;

        } catch (\Exception $e) {
            \Log::error('💥 Error generating certificate ID:', ['error' => $e->getMessage()]);
            
            // Emergency fallback dengan timestamp
            $timestamp = time();
            return "PAS-EMG-{$timestamp}-{$namaAlat}";
        }
    }

    private function getAlatType($namaAlat)
    {
        $namaAlat = strtolower($namaAlat);
        
        $alatMapping = [
            'inside micrometer' => 'inside_micrometer',
            'outside micrometer' => 'outside_micrometer',
            'vernier caliper' => 'vernier_caliper',
            'dial indicator' => 'dial_indicator',
            'dial test indicator' => 'dial_test_indicator',
            'height gauge' => 'height_gauge',
            'depth micrometer' => 'depth_micrometer',
            'thermometer infrared' => 'ir_thermometer',
            'thermometer' => 'thermometer',
            'depth caliper' => 'depth_caliper',
            'caliper' => 'caliper',
            'torque wrench' => 'torque_wrench',
            'torque meter' => 'torque_meter',
            'ultrasonic thickness gauge' => 'ultrasonic_thickness_gauge',
            'thickness gauge' => 'thickness_gauge',
            'penggaris' => 'penggaris',
            'oven' => 'enclosure',
            'freezer' => 'enclosure',
            'furnace' => 'enclosure',
            'incubator' => 'enclosure',
            'waterbath' => 'enclosure',
            'autoclave' => 'enclosure',
            'chamber' => 'chamber',
            'differential pressure gauge' => 'differential_pressure_gauge',
            'pressure gauge' => 'pressure_gauge',
            'buret' => 'volumetrik',
            'gelas ukur' => 'volumetrik',
            'pipet ukur ' => 'volumetrik',
            'labu ukur' => 'volumetrik',
            'pipet volume' => 'volumetrik',
            'thermohygrometer' => 'thermohygrometer',
            'viscometer' => 'viscometer',
            'push pull' => 'push_pull',
            'tension gauge' => 'push_pull',
            'anak timbangan' => 'anak_timbangan',
            'timbangan and moisture' => 'timbangan_moisture',
            'timbangan bias' => 'timbangan_bias',
            'timbangan' => 'timbangan',
            'gauge block' => 'gauge_block',
            'holetest' => 'holetest',
            'conductivity meter' => 'conductivity meter',
            'coating thickness' => 'coating_thickness',
            'durometer' => 'durometer',
            'mikropipet' => 'mikropipet_dispenset',
            'dispenset' => 'mikropipet_dispenset',
            'taper gauge' => 'taper_gauge',
            'feeler gauge' => 'feeler_gauge',
            'ph meter' => 'ph_meter',
            'tachometer' => 'tachometer',
            'pin gauge' => 'pin_gauge',
            'visco cup' => 'visco_cup',
            'plain limit gauge' => 'plain_limit_gauge',
            'thermo indicator' => 'thermo_indicator',
            'temperature transmitter' => 'temp_transmitter',
            'temperature' => 'temp_humid_transmitter',
            'humidity transmitter' => 'temp_humid_transmitter',
            'thermoindicator' => 'thermoindicator',
            'plastic shim' => 'plastic_shim',
            'profil projector' => 'profil_projector',
            'microscope' => 'profil_projector',
            'surface roughness tester' => 'surface_roughness_tester',
            'thread gauge' => 'thread_gauge',
            'stopwatch' => 'stopwatch',
            'centrifuge' => 'centrifuge',
            'mesin uji tarik' => 'utm',
            'mesin uji tekan' => 'utm',
            'pressure transmitter' => 'pressure_transmitter',
            'diff pressure transmitter' => 'pressure_transmitter',
            'surface plate' => 'surface_plate',
            'meja rata' => 'surface_plate',
          
           


            // Tambahkan mapping untuk alat lainnya di sini
        ];
        
      // Check dengan exact match terlebih dahulu untuk differential
      foreach ($alatMapping as $key => $type) {
        if (strpos($namaAlat, $key) !== false) {
            \Log::info("🔍 Form type detected:", [
                'namaAlat' => $namaAlat,
                'key' => $key,
                'type' => $type
            ]);
            return $type;
        }
    }
        
        // Default fallback
        return 'general';
    }

    // Method untuk update data spesifik alat
    private function updateAlatSpecificData($request, $calibration)
    {
        $alatType = $this->getAlatType($calibration->namaAlat);
        
        switch($alatType) {
            case 'inside_micrometer':
                $this->updateInsideMicrometer($request, $calibration);
                break;

            case 'outside_micrometer':
                $this->updateOutsideMicrometer($request, $calibration);
                break;

            case 'depth_micrometer':
                $this->updateDepthMicrometer($request, $calibration);
                break;

            case 'thermometer':
                $this->updateThermometer($request, $calibration);
                break;

            case 'depth_caliper':
                $this->updateDepthCaliper($request, $calibration);
                break;

            case 'caliper':
                $this->updateCaliper($request, $calibration);
                break;

                
            case 'torque_wrench':
                $this->updateTorqueWrench($request, $calibration);
                break;

            case 'torque_meter':
                $this->updateTorqueMeter($request, $calibration);
                break;

            case 'thickness_gauge':
                $this->updateThicknessGauge($request, $calibration);
                break;

            case 'penggaris':
                $this->updatePenggaris($request, $calibration);
                break;
            case 'enclosure':
                $this->updateEnclosure($request, $calibration);
                break;

            case 'climatic_chamber':
                $this->updateClimaticChamber($request, $calibration);
                break;
            case 'pressure_gauge':
                $this->updatePressureGauge($request, $calibration);
                break;

            case 'differential_pressure_gauge':
                $this->updateDifferentialPressureGauge($request, $calibration);
                break;

            case 'volumetrik':
                $this->updateVolumetrik($request, $calibration);
                break;

            case 'thermohygrometer':
                $this->updateThermohygrometer($request, $calibration);
                break;

            case 'viscometer':
                $this->updateViscometer($request, $calibration);
                break;

            case 'push_pull':
                $this->updatePushPull($request, $calibration);
                break;

            case 'timbangan':
                $this->updateTimbangan($request, $calibration);
                break;
            case 'timbangan_moisture':
                $this->updateTimbanganMoisture($request, $calibration);
                break;

            


                
            // Tambahkan case untuk alat lainnya
            default:
                // Tidak ada update spesifik untuk alat general
                break;
        }
    }

    private function updateInsideMicrometer($request, $calibration)
{
    \Log::channel('calibration')->info('🚀 ===== START updateInsideMicrometer =====', [
        'calibration_id' => $calibration->id,
        'certificate_id' => $calibration->headInsideMicrometer->certificate_id ?? 'N/A',
        'timestamp' => now()->toDateTimeString()
    ]);
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::channel('calibration')->info('🔧 ALAT STANDAR UPDATE:', [
            'count' => count($alatStandar),
            'items' => $alatStandar,
            'string_value' => $alatStandarString,
            'old_value' => $calibration->headInsideMicrometer->standard ?? 'null'
        ]);

        // Update head data
        if ($head = $calibration->headInsideMicrometer) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
            
            \Log::channel('calibration')->info('✅ HEAD DATA UPDATED:', [
                'head_id' => $head->id,
                'standard_updated' => true,
                'method_updated' => true
            ]);
        } else {
            \Log::channel('calibration')->warning('⚠️ NO HEAD DATA FOUND, creating new...');
            
            $head = HeadInsideMicrometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
            
            \Log::channel('calibration')->info('➕ NEW HEAD CREATED:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE DETAIL MEASUREMENTS
        // ==================================================================
        \Log::channel('calibration')->info('📊 DETAIL MEASUREMENTS UPDATE:', [
            'old_records_count' => DetailInsideMicrometer::where('calibration_id', $calibration->id)->count(),
            'new_titikUkur_count' => is_array($request->titikUkur) ? count(array_filter($request->titikUkur)) : 0
        ]);
        
        // Log sample of incoming data
        if (is_array($request->titikUkur) && count($request->titikUkur) > 0) {
            \Log::channel('calibration')->debug('📝 INCOMING DATA SAMPLE (first 3 rows):', [
                'row_1' => [
                    'titikUkur' => $request->titikUkur[0] ?? null,
                    'ulangan01' => $request->ulangan01[0] ?? null,
                    'ulangan02' => $request->ulangan02[0] ?? null,
                ],
                'row_2' => [
                    'titikUkur' => $request->titikUkur[1] ?? null,
                    'ulangan01' => $request->ulangan01[1] ?? null,
                    'ulangan02' => $request->ulangan02[1] ?? null,
                ],
                'row_3' => [
                    'titikUkur' => $request->titikUkur[2] ?? null,
                    'ulangan01' => $request->ulangan01[2] ?? null,
                    'ulangan02' => $request->ulangan02[2] ?? null,
                ]
            ]);
        }
        
        // Hapus data detail lama
        $deletedCount = DetailInsideMicrometer::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD DATA DELETED:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru - 14 BARIS
        $detailCount = 0;
        $errors = [];
        
        for ($i = 0; $i < 14; $i++) {
            $titikUkur = $request->titikUkur[$i] ?? null;
            $ulangan01 = $request->ulangan01[$i] ?? null;
            $ulangan02 = $request->ulangan02[$i] ?? null;
            $ulangan03 = $request->ulangan03[$i] ?? null;
            $ulangan04 = $request->ulangan04[$i] ?? null;
            $ulangan05 = $request->ulangan05[$i] ?? null;
            
            // Check if row has data
            $hasData = !empty(trim($titikUkur ?? '')) || 
                      !empty(trim($ulangan01 ?? '')) || 
                      !empty(trim($ulangan02 ?? '')) || 
                      !empty(trim($ulangan03 ?? '')) || 
                      !empty(trim($ulangan04 ?? '')) || 
                      !empty(trim($ulangan05 ?? ''));
            
            if ($hasData) {
                try {
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $titikUkur,
                        'ulangan01' => $this->formatNumericValue($ulangan01),
                        'ulangan02' => $this->formatNumericValue($ulangan02),
                        'ulangan03' => $this->formatNumericValue($ulangan03),
                        'ulangan04' => $this->formatNumericValue($ulangan04),
                        'ulangan05' => $this->formatNumericValue($ulangan05),
                    ];
                    
                    \Log::channel('calibration')->debug("💾 SAVING ROW {$i}:", [
                        'row' => $i,
                        'data' => $detailData
                    ]);
                    
                    DetailInsideMicrometer::create($detailData);
                    $detailCount++;
                    
                } catch (\Exception $rowError) {
                    $errors[] = "Row {$i}: " . $rowError->getMessage();
                    \Log::channel('calibration')->error("❌ ROW {$i} SAVE ERROR:", [
                        'error' => $rowError->getMessage(),
                        'data' => compact('titikUkur', 'ulangan01', 'ulangan02')
                    ]);
                }
            } else {
                \Log::channel('calibration')->debug("⏭️ SKIPPING EMPTY ROW {$i}");
            }
        }
        
        \Log::channel('calibration')->info("✅ DETAIL DATA SAVED:", [
            'total_records' => $detailCount,
            'errors_count' => count($errors),
            'errors' => $errors
        ]);

        // ==================================================================
        // 3. VERIFY SAVED DATA
        // ==================================================================
        $savedDetails = DetailInsideMicrometer::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::channel('calibration')->info('🔍 VERIFY SAVED DATA:', [
            'total_saved' => $savedDetails->count(),
            'first_3_rows_sample' => $savedDetails->take(3)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkur' => $item->titikUkur,
                    'ulangan01' => $item->ulangan01,
                    'ulangan02' => $item->ulangan02,
                    'created_at' => $item->created_at
                ];
            })->toArray()
        ]);

        // ==================================================================
        // 4. UPDATE CALIBRATION ADDITIONAL DATA
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibratedBy')) {
            $updateData['calibrated_by'] = $request->calibratedBy;
        }
        
        if ($request->filled('verifiedBy')) {
            $updateData['verified_by'] = $request->verifiedBy;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::channel('calibration')->info('📝 CALIBRATION ADDITIONAL DATA UPDATED:', $updateData);
        }

        // ==================================================================
        // 5. FINAL SUMMARY
        // ==================================================================
        $finalDetailCount = DetailInsideMicrometer::where('calibration_id', $calibration->id)->count();
        
        \Log::channel('calibration')->info('📋 UPDATE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'certificate_id' => $head->certificate_id ?? 'N/A',
            'detail_records' => $finalDetailCount,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by,
            'verified_by' => $calibration->verified_by,
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_peak' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);

        \Log::channel('calibration')->info('🎉 updateInsideMicrometer COMPLETED SUCCESSFULLY');
        return true;

    } catch (\Exception $e) {
        \Log::channel('calibration')->error('💥 updateInsideMicrometer FAILED:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}


   private function updateOutsideMicrometer($request, $calibration)
{
    \Log::channel('calibration')->info('🚀 ===== START updateOutsideMicrometer =====', [
        'calibration_id' => $calibration->id,
        'certificate_id' => $calibration->headOutsideMicrometer->certificate_id ?? 'N/A',
        'timestamp' => now()->toDateTimeString()
    ]);
    
    try {
        // ==================================================================
        // 1. UPDATE ALAT STANDAR
        // ==================================================================
        $alatStandar = $request->alat_standar ?? [];
        $alatStandarString = !empty($alatStandar) ? implode(', ', $alatStandar) : '';
        
        \Log::channel('calibration')->info('🔧 ALAT STANDAR UPDATE:', [
            'count' => count($alatStandar),
            'items' => $alatStandar,
            'string_value' => $alatStandarString,
            'old_value' => $calibration->headOutsideMicrometer->standard ?? 'null'
        ]);

        // Update head data
        if ($head = $calibration->headOutsideMicrometer) {
            $head->update([
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
            
            \Log::channel('calibration')->info('✅ HEAD DATA UPDATED:', [
                'head_id' => $head->id,
                'standard_updated' => true,
                'method_updated' => true
            ]);
        } else {
            \Log::channel('calibration')->warning('⚠️ NO HEAD DATA FOUND, creating new...');
            
            $head = HeadOutsideMicrometer::create([
                'calibration_id' => $calibration->id,
                'certificate_id' => $calibration->certificate_id ?? 'NEW-' . time(),
                'standard' => $alatStandarString,
                'calibrationMethod' => 'PAS-IK1102-01 (JIS B 7502:2016 (JMA/JSA); SNSU PK.P-01:2020)',
            ]);
            
            \Log::channel('calibration')->info('➕ NEW HEAD CREATED:', ['head_id' => $head->id]);
        }

        // ==================================================================
        // 2. UPDATE ADD OUTSIDE MICROMETER (UJI KERATAAN)
        // ==================================================================
        \Log::channel('calibration')->info('📊 ADD OUTSIDE MICROMETER UPDATE (Uji Kerataan):');
        
        $addData = [
            'ukuranAnvil1' => $request->ukuranAnvil1 ?? null,
            'jumlahAnvil1' => $request->jumlahAnvil1 ?? null,
            'ukuranAnvil2' => $request->ukuranAnvil2 ?? null,
            'jumlahAnvil2' => $request->jumlahAnvil2 ?? null,
            'ukuranSpindle1' => $request->ukuranSpindle1 ?? null,
            'jumlahSpindle1' => $request->jumlahSpindle1 ?? null,
            'ukuranSpindle2' => $request->ukuranSpindle2 ?? null,
            'jumlahSpindle2' => $request->jumlahSpindle2 ?? null,
        ];
        
        \Log::channel('calibration')->debug('📝 ADD DATA:', $addData);
        
        if ($add = $calibration->addOutsideMicrometer) {
            $add->update($addData);
            \Log::channel('calibration')->info('✅ ADD DATA UPDATED:', ['add_id' => $add->id]);
        } else {
            $addData['calibration_id'] = $calibration->id;
            $add = AddOutsideMicrometer::create($addData);
            \Log::channel('calibration')->info('➕ NEW ADD CREATED:', ['add_id' => $add->id]);
        }

        // ==================================================================
        // 3. UPDATE DETAIL MEASUREMENTS
        // ==================================================================
        \Log::channel('calibration')->info('📊 DETAIL MEASUREMENTS UPDATE:', [
            'old_records_count' => DetailOutsideMicrometer::where('calibration_id', $calibration->id)->count(),
            'new_titikUkur_count' => is_array($request->titikUkur) ? count(array_filter($request->titikUkur)) : 0
        ]);
        
        // Log sample of incoming data
        if (is_array($request->titikUkur) && count($request->titikUkur) > 0) {
            \Log::channel('calibration')->debug('📝 INCOMING DATA SAMPLE (first 3 rows):', [
                'row_1' => [
                    'titikUkur' => $request->titikUkur[0] ?? null,
                    'ulangan01' => $request->ulangan01[0] ?? null,
                    'ulangan02' => $request->ulangan02[0] ?? null,
                ],
                'row_2' => [
                    'titikUkur' => $request->titikUkur[1] ?? null,
                    'ulangan01' => $request->ulangan01[1] ?? null,
                    'ulangan02' => $request->ulangan02[1] ?? null,
                ],
                'row_3' => [
                    'titikUkur' => $request->titikUkur[2] ?? null,
                    'ulangan01' => $request->ulangan01[2] ?? null,
                    'ulangan02' => $request->ulangan02[2] ?? null,
                ]
            ]);
        }
        
        // Hapus data detail lama
        $deletedCount = DetailOutsideMicrometer::where('calibration_id', $calibration->id)->delete();
        \Log::channel('calibration')->info('🗑️ OLD DATA DELETED:', ['deleted_count' => $deletedCount]);
        
        // Simpan data detail baru - 14 BARIS
        $detailCount = 0;
        $errors = [];
        
        for ($i = 0; $i < 14; $i++) {
            $titikUkur = $request->titikUkur[$i] ?? null;
            $ulangan01 = $request->ulangan01[$i] ?? null;
            $ulangan02 = $request->ulangan02[$i] ?? null;
            $ulangan03 = $request->ulangan03[$i] ?? null;
            $ulangan04 = $request->ulangan04[$i] ?? null;
            $ulangan05 = $request->ulangan05[$i] ?? null;
            
            // Check if row has data
            $hasData = !empty(trim($titikUkur ?? '')) || 
                      !empty(trim($ulangan01 ?? '')) || 
                      !empty(trim($ulangan02 ?? '')) || 
                      !empty(trim($ulangan03 ?? '')) || 
                      !empty(trim($ulangan04 ?? '')) || 
                      !empty(trim($ulangan05 ?? ''));
            
            if ($hasData) {
                try {
                    $detailData = [
                        'calibration_id' => $calibration->id,
                        'titikUkur' => $titikUkur,
                        'ulangan01' => $this->formatNumericValue($ulangan01),
                        'ulangan02' => $this->formatNumericValue($ulangan02),
                        'ulangan03' => $this->formatNumericValue($ulangan03),
                        'ulangan04' => $this->formatNumericValue($ulangan04),
                        'ulangan05' => $this->formatNumericValue($ulangan05),
                    ];
                    
                    \Log::channel('calibration')->debug("💾 SAVING ROW {$i}:", [
                        'row' => $i,
                        'data' => $detailData
                    ]);
                    
                    DetailOutsideMicrometer::create($detailData);
                    $detailCount++;
                    
                } catch (\Exception $rowError) {
                    $errors[] = "Row {$i}: " . $rowError->getMessage();
                    \Log::channel('calibration')->error("❌ ROW {$i} SAVE ERROR:", [
                        'error' => $rowError->getMessage(),
                        'data' => compact('titikUkur', 'ulangan01', 'ulangan02')
                    ]);
                }
            } else {
                \Log::channel('calibration')->debug("⏭️ SKIPPING EMPTY ROW {$i}");
            }
        }
        
        \Log::channel('calibration')->info("✅ DETAIL DATA SAVED:", [
            'total_records' => $detailCount,
            'errors_count' => count($errors),
            'errors' => $errors
        ]);

        // ==================================================================
        // 4. VERIFY SAVED DATA
        // ==================================================================
        $savedDetails = DetailOutsideMicrometer::where('calibration_id', $calibration->id)
            ->orderBy('id')
            ->get();
            
        \Log::channel('calibration')->info('🔍 VERIFY SAVED DATA:', [
            'total_saved' => $savedDetails->count(),
            'first_3_rows_sample' => $savedDetails->take(3)->map(function($item) {
                return [
                    'id' => $item->id,
                    'titikUkur' => $item->titikUkur,
                    'ulangan01' => $item->ulangan01,
                    'ulangan02' => $item->ulangan02,
                    'created_at' => $item->created_at
                ];
            })->toArray()
        ]);

        // ==================================================================
        // 5. UPDATE CALIBRATION ADDITIONAL DATA
        // ==================================================================
        $updateData = [];
        
        if ($request->filled('calibratedBy')) {
            $updateData['calibrated_by'] = $request->calibratedBy;
        }
        
        if ($request->filled('verifiedBy')) {
            $updateData['verified_by'] = $request->verifiedBy;
        }
        
        if ($request->filled('uncertainty')) {
            $updateData['uncertainty'] = $request->uncertainty;
            $updateData['keterangan'] = $request->conclusion ?? 'Alat diterima, memenuhi kriteria kalibrasi';
        }
        
        if (!empty($updateData)) {
            $calibration->update($updateData);
            \Log::channel('calibration')->info('📝 CALIBRATION ADDITIONAL DATA UPDATED:', $updateData);
        }

        // ==================================================================
        // 6. FINAL SUMMARY
        // ==================================================================
        $finalDetailCount = DetailOutsideMicrometer::where('calibration_id', $calibration->id)->count();
        $finalAddCount = AddOutsideMicrometer::where('calibration_id', $calibration->id)->count();
        
        \Log::channel('calibration')->info('📋 UPDATE SUMMARY:', [
            'calibration_id' => $calibration->id,
            'certificate_id' => $head->certificate_id ?? 'N/A',
            'detail_records' => $finalDetailCount,
            'add_records' => $finalAddCount,
            'alat_standar' => $alatStandarString,
            'calibrated_by' => $calibration->calibrated_by,
            'verified_by' => $calibration->verified_by,
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_peak' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);

        \Log::channel('calibration')->info('🎉 updateOutsideMicrometer COMPLETED SUCCESSFULLY');
        return true;

    } catch (\Exception $e) {
        \Log::channel('calibration')->error('💥 updateOutsideMicrometer FAILED:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'calibration_id' => $calibration->id ?? 'unknown'
        ]);
        throw $e;
    }
}
public function update(Request $request, $id)
{
    // Hapus semua channel('calibration') dan ganti dengan \Log::
    \Log::info('🎯 ===== UPDATE METHOD CALLED =====', [
        'calibration_id' => $id,
        'user' => auth()->user()->nama ?? 'unknown',
        'timestamp' => now()->toDateTimeString(),
        'ip' => request()->ip()
    ]);
    
    \Log::info('📦 REQUEST DATA SAMPLE:', [
        'namaAlat' => $request->namaAlat ?? 'not_set',
        'brandAlat' => $request->brandAlat ?? 'not_set',
        'NoSeri' => $request->NoSeri ?? 'not_set',
        'calibratedBy' => $request->calibratedBy ?? 'not_set',
        'alat_standar_count' => is_array($request->alat_standar) ? count($request->alat_standar) : 0,
        'titikUkur_count' => is_array($request->titikUkur) ? count($request->titikUkur) : 0,
        'has_files' => $request->hasFile('files') ? 'yes' : 'no'
    ]);
    
    \Log::debug('🔍 FULL REQUEST DATA DUMP:', $request->all());
    
    try {
        $calibration = Calibration::findOrFail($id);
        
        \Log::info('🔍 CALIBRATION FOUND:', [
            'id' => $calibration->id,
            'current_namaAlat' => $calibration->namaAlat,
            'current_status' => $calibration->status,
            'created_at' => $calibration->created_at
        ]);
        
        // PERHATIAN: Validasi ini menggunakan 'calibratedBy' (camelCase)
        // Tapi form Dial Indicator menggunakan 'calibrated_by' (snake_case)
        $validated = $request->validate([
            'namaAlat' => 'nullable',
            'brandAlat' => 'nullable',
            'kodeAlat' => 'nullable',
            'typeAlat' => 'nullable',
            'NoSeri' => 'nullable',
            'kapasitas' => 'nullable',
            'resolusi' => 'nullable',
            'rangeMin' => 'nullable',
            'rangeMax' => 'nullable',
            'pemilikAlat' => 'nullable',
            'tanggalMasuk' => 'nullable|date',
            'tanggalKalibrasi' => 'nullable|date',
            'jenisPembacaan' => 'nullable',
            'tempatKalibrasi' => 'nullable',
            'lokasiPT' => 'nullable',
            'kondisiAlat' => 'nullable',
            'keterangan' => 'nullable',
            'RT_condition1' => 'nullable',
            'RT_condition2' => 'nullable',
            'RT_condition3' => 'nullable',
            'RH_condition1' => 'nullable',
            'RH_condition2' => 'nullable',
            'RH_condition3' => 'nullable',
            'alat_standar' => 'nullable|array',
            'alat_standar.*' => 'string',
            'calibratedBy' => 'nullable', // INI camelCase
            'verifiedBy' => 'nullable',   // INI camelCase
        ]);
        
        \Log::info('✅ VALIDATION PASSED FOR UPDATE');
        
        // Log alat standar yang dipilih
        $alatStandar = $request->alat_standar ?? [];
        \Log::info('🔧 ALAT STANDAR SELECTED:', [
            'count' => count($alatStandar),
            'items' => $alatStandar,
            'string' => implode(', ', $alatStandar)
        ]);
        
        // Log detail data
        $titikUkurCount = is_array($request->titikUkur) ? count(array_filter($request->titikUkur)) : 0;
        \Log::info('📊 DETAIL DATA:', [
            'titikUkur_count' => $titikUkurCount,
            'ulangan01_count' => is_array($request->ulangan01) ? count(array_filter($request->ulangan01, function($v) { return !is_null($v) && $v !== ''; })) : 0,
            'ulangan02_count' => is_array($request->ulangan02) ? count(array_filter($request->ulangan02, function($v) { return !is_null($v) && $v !== ''; })) : 0,
            'ulangan03_count' => is_array($request->ulangan03) ? count(array_filter($request->ulangan03, function($v) { return !is_null($v) && $v !== ''; })) : 0,
            'ulangan04_count' => is_array($request->ulangan04) ? count(array_filter($request->ulangan04, function($v) { return !is_null($v) && $v !== ''; })) : 0,
            'ulangan05_count' => is_array($request->ulangan05) ? count(array_filter($request->ulangan05, function($v) { return !is_null($v) && $v !== ''; })) : 0,
        ]);
        
        // Update data dasar calibration
        // PERHATIAN: Ini menggunakan 'calibratedBy' dari request
        $calibrationData = [
            'namaAlat' => $request->namaAlat,
            'brandAlat' => $request->brandAlat,
            'kodeAlat' => $request->kodeAlat,
            'typeAlat' => $request->typeAlat,
            'NoSeri' => $request->NoSeri,
            'kapasitas' => $request->kapasitas,
            'resolusi' => $request->resolusi,
            'rangeMin' => $request->rangeMin,
            'rangeMax' => $request->rangeMax,
            'pemilikAlat' => $request->pemilikAlat,
            'tanggalMasuk' => $request->tanggalMasuk,
            'tanggalKalibrasi' => $request->tanggalKalibrasi,
            'tempatKalibrasi' => $request->tempatKalibrasi,
            'kondisiAlat' => $request->kondisiAlat,
            'keterangan' => $request->keterangan,
            'RT_condition1' => $request->RT_condition1,
            'RT_condition2' => $request->RT_condition2,
            'RT_condition3' => $request->RT_condition3,
            'RH_condition1' => $request->RH_condition1,
            'RH_condition2' => $request->RH_condition2,
            'RH_condition3' => $request->RH_condition3,
            'calibratedBy' => $request->calibratedBy, // camelCase dari request
            'verifiedBy' => $request->verifiedBy,     // camelCase dari request
            'jenisPembacaan' => $request->jenisPembacaan,
            'lokasiPT' => $request->lokasiPT,
        ];
        
        \Log::info('📝 UPDATING CALIBRATION BASIC DATA:', [
            'fields_updated' => array_keys($calibrationData),
            'data_sample' => [
                'namaAlat' => $request->namaAlat,
                'NoSeri' => $request->NoSeri,
                'tanggalKalibrasi' => $request->tanggalKalibrasi,
                'calibratedBy' => $request->calibratedBy // Tampilkan value
            ]
        ]);
        
        $calibration->update($calibrationData);
        
        \Log::info('✅ CALIBRATION BASIC DATA UPDATED', [
            'rows_affected' => 1,
            'new_status' => $calibration->status
        ]);

        // Tentukan jenis alat berdasarkan nama alat
        $formType = $this->getAlatType($calibration->namaAlat);
        
        \Log::info('🔧 FORM TYPE DETECTED:', [
            'namaAlat' => $calibration->namaAlat,
            'detected_type' => $formType,
            'detection_method' => 'getAlatType'
        ]);

        // Panggil metode update spesifik berdasarkan nama alat
        switch($formType) {
            case 'inside_micrometer':
                \Log::info('🎯 CALLING updateInsideMicrometer');
                $this->updateInsideMicrometer($request, $calibration);
                break;
            case 'outside_micrometer':
                \Log::info('🎯 CALLING updateOutsideMicrometer');
                $this->updateOutsideMicrometer($request, $calibration);
                break;
            case 'depth_micrometer':
                \Log::info('🎯 CALLING updateDepthMicrometer');
                $this->updateDepthMicrometer($request, $calibration);
                break;
            case 'thermometer':
                \Log::info('🎯 CALLING updateThermometer');
                $this->updateThermometer($request, $calibration);
                break;

            case 'dial_indicator':
                \Log::info('🎯 CALLING updateDialIndicator');
                $this->updateDialIndicator($request, $calibration);
                break;

            case 'dial_test_indicator':
                \Log::info('🎯 CALLING updateDialTestIndicator');
                $this->updateDialTestIndicator($request, $calibration);
                break;
             case 'depth_caliper':
                \Log::info('🎯 CALLING updateDepthCaliper');
                $this->updateDepthCaliper($request, $calibration);
                break;

            case 'caliper':
                \Log::info('🎯 CALLING updateCaliper');
                $this->updateCaliper($request, $calibration);
                break;

            case 'torque_wrench':
                \Log::info('🎯 CALLING updateTorqueWrench');
                $this->updateTorqueWrench($request, $calibration);
                break;

             case 'torque_meter':
                \Log::info('🎯 CALLING updateTorqueMeter');
                $this->updateTorqueMeter($request, $calibration);
                break;
                
            default:
                \Log::warning('⚠️ UNKNOWN FORM TYPE:', [
                    'formType' => $formType,
                    'namaAlat' => $calibration->namaAlat
                ]);
                break;
        }

        \Log::info('✅ UPDATE COMPLETED SUCCESSFULLY', [
            'calibration_id' => $id,
            'execution_time' => microtime(true) - LARAVEL_START,
            'memory_usage' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);

        return redirect()->route('calibrations.index')
            ->with('success', 'Data kalibrasi berhasil diperbarui!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('❌ VALIDATION ERROR:', [
            'errors' => $e->errors(),
            'input' => $request->except(['password', '_token'])
        ]);
        
        return redirect()->back()
            ->withErrors($e->errors())
            ->withInput();
            
    } catch (\Exception $e) {
        \Log::error('💥 UPDATE METHOD ERROR:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
            'calibration_id' => $id ?? 'unknown'
        ]);
        
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}


    public function index(Request $request)
    {

        $perPage = $request->get('perPage', 5); // Default 5 data per halaman
        $calibrations = Calibration::with([
            'headInsideMicrometer', 
            'detailInsideMicrometers',
            'headOutsideMicrometer',
            'detailOutsideMicrometers',
            'addOutsideMicrometer',
            'detailDepthMicrometers',
            'headDepthMicrometer',
            'headThermometer',
            'DetailThermometers',
            'headDialIndicator',
            'detailDialIndicators',
            'AddDialIndicator',
            'headDialTestIndicator',
            'detailDialTestIndicators',
            'AddDialTestIndicator',
            'headDepthCaliper',
            'detailDepthCalipers',
            'headCaliper',
            'detailCalipers',
            'addCaliper',
            'headTorqueWrench',
            'detailTorqueWrenchs',
            'addTorqueWrench',
            'headTorqueMeter',
            'detailTorqueMeters',
            'addTorqueMeter',
            'headUltrasonicThicknessGauge',
            'detailUltrasonicThicknessGauges',
            'headThicknessGauge',
            'detailThicknessGauges',
            'headPenggaris',
            'detailPenggariss',
            'headEnclosure',
            'detailEnclosures',
            'addEnclosure',
            'headChamber',
            'detailChambers',
            'addChamber',
            'headPressureGauge',
            'detailPressureGauges',
            'addPressureGauge',
            'headDifferentialPressureGauge',
            'detailDifferentialPressureGauges',
            'addDifferentialPressureGauge',
            'headVolumetrik',
            'detailVolumetriks',
            'addVolumetrik',
            'headPushPull',
            'detailPushPulls',
            'addPushPull',
            'headAnakTimbangan',
            'detailAnakTimbangans',
            'headTimbangan',
            'detailTimbangans',
            'addTimbangan',
            'headTimbanganMoisture',
            'detailTimbanganMoistures',
            'addTimbanganMoisture',
            'headGaugeBlock',
            'detailGaugeBlocks',
            'addGaugeBlock',
            'headHoletest',
            'detailHoletests',
            'HeadConductivityMeter',
            'detailConductivityMeters',
            'HeadCoatingThickness',
            'detailCoatingThicknesses',
            'headDurometer',
            'detailDurometers',
            'addDurometer',
            'headMikropipetDispenset',
            'detailMikropipetDispensets',
            'headTaperGauge',
            'detailTaperGauges',
            'headFeelerGauge',
            'detailFeelerGauges',
            'headPhMeter',
            'detailPhMeters',
            'headTachometer',
            'detailTachometers',
            'headPinGauge',
            'detailPinGauges',
            'headViscoCup',
            'detailViscoCups',
            'addViscoCup',
            'headPlainLimitGauge',
            'detailPlainLimitGauges',
            'headTempHumidTransmitter',
            'detail_T_TempHumidTransmitters',
            'detail_RH_TempHumidTransmitters',
            'headTempTransmitter',
            'detailTempTransmitters',
            'headIrThermometer',
            'detailIrThermometers',
            'addIrThermometer',
            'headThermoIndicator',
            'detailThermoIndicators',
            'addThermoIndicator',
            'headPlasticShim',
            'detailPlasticShims',
            'headProfilProjector',
            'detailProfilProjectors',
            'headSurfaceRoughnessTester',
            'detailSurfaceRoughnessTesters',
            'headThreadGauge',
            'detailThreadGauges',
            'headStopwatch',
            'detailStopwatches',
            'headCentrifuge',
            'detailCentrifuges',
            'headUtm',
            'detailUtms',
            'headPressureTransmitter',
            'detailPressureTransmitters',
            'addPressureTransmitter',
            'headSurfacePlate',
            'detailSurfacePlates',
            ])->orderBy('created_at', 'desc')
            ->paginate($perPage)
        ->withQueryString(); // Menjaga parameter query string
        
        
        return view('calibrations.index', compact('calibrations'));
    }
    public function show($id,Request $request)
    {
        $calibration = Calibration::with([
            'headInsideMicrometer', 
            'detailInsideMicrometers',
            'headOutsideMicrometer',
            'detailOutsideMicrometers',
            'addOutsideMicrometer',
            'detailDepthMicrometers',
            'headDepthMicrometer',
            'headIrThermometer',
            'detailIrThermometers',
            'addIrThermometer',
            'headThermometer',
            'detailThermometers',
            'headDialIndicator',
            'detailDialIndicators',
            'AddDialIndicator',
            'headDialTestIndicator',
            'detailDialTestIndicators',
            'AddDialTestIndicator',
            'headDepthCaliper',
            'detailDepthCalipers',
            'headCaliper',
            'detailCalipers',
            'addCaliper',
            'headTorqueWrench',
            'detailTorqueWrenchs',
            'addTorqueWrench',
            'headTorqueMeter',
            'detailTorqueMeters',
            'addTorqueMeter',
            'headUltrasonicThicknessGauge',
            'detailUltrasonicThicknessGauges',
            'headThicknessGauge',
            'detailThicknessGauges',
            'headPenggaris',
            'detailPenggariss',
            'headEnclosure',
            'detailEnclosures',
            'addEnclosure',
            'headChamber',
            'detailChambers',
            'addChamber',
            'headPressureGauge',
            'detailPressureGauges',
            'addPressureGauge',
            'headDifferentialPressureGauge',
            'detailDifferentialPressureGauges',
            'addDifferentialPressureGauge',
            'headVolumetrik',
            'detailVolumetriks',
            'addVolumetrik',
            'headPushPull',
            'detailPushPulls',
            'addPushPull',
            'headAnakTimbangan',
            'detailAnakTimbangans',
            'headTimbangan',
            'detailTimbangans',
            'addTimbangan',
            'headTimbanganMoisture',
            'detailTimbanganMoistures',
            'addTimbanganMoisture',
            'headTimbanganBias',
            'detailTimbanganBiass',
            'addTimbanganBias',
            'headGaugeBlock',
            'detailGaugeBlocks',
            'addGaugeBlock',
            'headHoletest',
            'detailHoletests',
            'HeadConductivityMeter',
            'detailConductivityMeters',
            'HeadCoatingThickness',
            'detailCoatingThicknesses',
            'headDurometer',
            'detailDurometers',
            'addDurometer',
            'headMikropipetDispenset',
            'detailMikropipetDispensets',
            'headTaperGauge',
            'detailTaperGauges',
            'headFeelerGauge',
            'detailFeelerGauges',
            'headPhMeter',
            'detailPhMeters',
            'headTachometer',
            'detailTachometers',
            'headPinGauge',
            'detailPinGauges',
            'headViscoCup',
            'detailViscoCups',
            'addViscoCup',
            'headPlainLimitGauge',
            'detailPlainLimitGauges',
            'headTempHumidTransmitter',
            'detail_T_TempHumidTransmitters',
            'detail_RH_TempHumidTransmitters',
            'headTempTransmitter',
            'detailTempTransmitters',
            'headThermoIndicator',
            'detailThermoIndicators',
            'addThermoIndicator',
            'headPlasticShim',
            'detailPlasticShims',
            'headProfilProjector',
            'detailProfilProjectors',
            'headSurfaceRoughnessTester',
            'detailSurfaceRoughnessTesters',
            'headThreadGauge',
            'detailThreadGauges',
            'headStopwatch',
            'detailStopwatches',
            'headCentrifuge',
            'detailCentrifuges',
            'headUtm',
            'detailUtms',
            'headPressureTransmitter',
            'detailPressureTransmitters',
            'addPressureTransmitter',
            'headSurfacePlate',
            'detailSurfacePlates',
        ])->findOrFail($id);
            
        // Tentukan form type berdasarkan nama alat
        $formType = $this->getAlatType($calibration->namaAlat);
        // Tentukan mode (view atau edit)
            $mode = $request->get('mode', 'view'); // Default adalah view
           // DEBUG LOG DETAIL
    \Log::info('🎯 SHOW CALIBRATION DETAIL:', [
        'id' => $id,
        'namaAlat' => $calibration->namaAlat,
        'namaAlat_lower' => strtolower($calibration->namaAlat),
        'formType_detected' => $formType,
        'is_pressure_gauge' => strpos(strtolower($calibration->namaAlat), 'pressure gauge') !== false,
        'is_differential_pressure_gauge' => strpos(strtolower($calibration->namaAlat), 'differential pressure') !== false,
        'has_headPressureGauge' => !is_null($calibration->headPressureGauge),
        'has_headDifferentialPressureGauge' => !is_null($calibration->headDifferentialPressureGauge),
        'detailPressureGauges_count' => $calibration->detailPressureGauges->count(),
        'detailDifferentialPressureGauges_count' => $calibration->detailDifferentialPressureGauges->count(),
    ]);

          // LOG KE STORAGE UNTUK DEBUG
    \Log::channel('daily')->info('CALIBRATION SHOW DEBUG:', [
        'id' => $calibration->id,
        'namaAlat' => $calibration->namaAlat,
        'namaAlat_lower' => strtolower($calibration->namaAlat),
        'formType' => $formType,
        'is_thickness_gauge' => str_contains(strtolower($calibration->namaAlat), 'thickness gauge'),
        'has_head' => !is_null($calibration->headThicknessGauge),
        'detail_count' => $calibration->detailThicknessGauges->count(),
        'all_conditions' => [
            'inside_micrometer' => $formType == 'inside_micrometer',
            'outside_micrometer' => $formType == 'outside_micrometer',
            'thickness_gauge' => $formType == 'thickness_gauge',
            'penggaris' => $formType == 'penggaris',
        ]
    ]);
        
        
    return view('calibrations.show', compact('calibration', 'formType', 'mode'));
    }

    public function edit($id)
    {
        $calibration = Calibration::with([
            'headInsideMicrometer', 
            'detailInsideMicrometers',
            'headOutsideMicrometer',
            'detailOutsideMicrometers',
            'addOutsideMicrometer',
            'detailDepthMicrometers',
            'headDepthMicrometer',
            'headThermometer',
            'detailThermometers',
            'headDialIndicator',
            'detailDialIndicators',
            'AddDialIndicator',
            'headDialTestIndicator',
            'detailDialTestIndicators',
            'AddDialTestIndicator',
            'headDepthCaliper',
            'detailDepthCalipers',
            'headCaliper',
            'detailCalipers',
            'addCaliper',
            'headTorqueWrench',
            'detailTorqueWrenchs',
            'addTorqueWrench',
            'headTorqueMeter',
            'detailTorqueMeters',
            'addTorqueMeter',
            'headUltrasonicThicknessGauge',
            'detailUltrasonicThicknessGauges',
            'headThicknessGauge',
            'detailThicknessGauges',
            'headPenggaris',
            'detailPenggariss',
            'headEnclosure',
            'detailEnclosures',
            'addEnclosure',
            'headChamber',
            'detailChambers',
            'addChamber',
            'headPressureGauge',
            'detailPressureGauges',
            'addPressureGauge',
            'headDifferentialPressureGauge',
            'detailDifferentialPressureGauges',
            'addDifferentialPressureGauge',
            'headVolumetrik',
            'detailVolumetriks',
            'addVolumetrik',
            'headPushPull',
            'detailPushPulls',
            'addPushPull',
            'headTimbangan',
            'detailTimbangans',
            'addTimbangan',
            'headTimbanganMoisture',
            'detailTimbanganMoistures',
            'addTimbanganMoisture',
            'headTimbanganBias',
            'detailTimbanganBiass',
            'addTimbanganBias',
            'headGaugeBlock',
            'detailGaugeBlocks',
            'addGaugeBlock',
            'headHoletest',
            'detailHoletests',
            'HeadConductivityMeter',
            'detailConductivityMeters',
            'HeadCoatingThickness',
            'detailCoatingThicknesses',
            'headDurometer',
            'detailDurometers',
            'addDurometer',
            'headMikropipetDispenset',
            'detailMikropipetDispensets',   
            'headTaperGauge',
            'detailTaperGauges',
            'headPhMeter',
            'detailPhMeters',
            'headTachometer',
            'detailTachometers',
            'headPinGauge',
            'detailPinGauges',
            'headViscoCup',
            'detailViscoCups',
            'addViscoCup',
            'headPlainLimitGauge',
            'detailPlainLimitGauges',  
            'headTempHumidTransmitter',
            'detail_T_TempHumidTransmitters',
            'detail_RH_TempHumidTransmitters',
            'headTempTransmitter',
            'detailTempTransmitters',
            'headIrThermometer',
            'detailIrThermometers',
            'addIrThermometer',
            'headThermoIndicator',
            'detailThermoIndicators',
            'addThermoIndicator',
            'headPlasticShim',
            'detailPlasticShims',
            'headProfilProjector',
            'detailProfilProjectors',
            'headSurfaceRoughnessTester',
            'detailSurfaceRoughnessTesters',
            'headThreadGauge',
            'detailThreadGauges',
            'headStopwatch',
            'detailStopwatches',
            'headCentrifuge',
            'detailCentrifuges',
            'headUtm',
            'detailUtms',
            'headAnakTimbangan',
            'detailAnakTimbangans',
            'headPressureTransmitter',
            'detailPressureTransmitters',
            'addPressureTransmitter',
            'headSurfacePlate',
            'detailSurfacePlates',
        ])->findOrFail($id);
            
        return view('calibrations.edit', compact('calibration'));
    }

    //  public function update(Request $request, $id)
    // {
    //     \Log::info('🎯 UPDATE METHOD CALLED');
        
    //     try {
    //         $calibration = Calibration::findOrFail($id);
            
    //         // Validasi data dasar
    //         $request->validate([
    //             'nama_alat' => 'required',
    //             'merek' => 'required',
    //             'kode_alat' => 'nullable',
    //             'type_alat' => 'nullable',
    //             'no_seri' => 'required',
    //             'kapasitas' => 'required',
    //             'resolusi' => 'required',
    //             'rentang_ukur_min' => 'nullable',
    //             'rentang_ukur_max' => 'nullable',
    //             'nama_pemilik' => 'required',
    //             'tanggal_alat_masuk' => 'required|date',
    //             'tanggal_kalibrasi' => 'required|date',
    //             'jenis_pembacaan' => 'nullable',
    //             'tempat_kalibrasi' => 'required',
    //             'lokasi_pt' => 'nullable',
    //             'fungsi_komponen' => 'required',
    //             'suhu_awal' => 'required',
    //             'suhu_tengah' => 'required',
    //             'suhu_akhir' => 'required',
    //             'rh_awal' => 'required',
    //             'rh_tengah' => 'required',
    //             'rh_akhir' => 'required',
    //             'alat_standar_text' => 'required_without:alat_standar|string',
    //             'alat_standar' => 'nullable|array',
    //             'alat_standar.*' => 'string',
    //             'calibrated_by' => 'required',
    //             'verified_by' => 'required',
    //             'type' => 'nullable',
    //         ]);

    //         \Log::info('✅ VALIDATION PASSED FOR UPDATE');

    //         // Update data dasar calibration
    //         $calibrationData = [
    //             'namaAlat' => $request->nama_alat,
    //             'brandAlat' => $request->merek,
    //             'kodeAlat' => $request->kode_alat,
    //             'typeAlat' => $request->type_alat,
    //             'NoSeri' => $request->no_seri,
    //             'kapasitas' => $request->kapasitas,
    //             'resolusi' => $request->resolusi,
    //             'rangeMin' => $request->rentang_ukur_min,
    //             'rangeMax' => $request->rentang_ukur_max,
    //             'type' => $request->type,
    //             'pemilikAlat' => $request->nama_pemilik,
    //             'tanggalMasuk' => $request->tanggal_alat_masuk,
    //             'tanggalKalibrasi' => $request->tanggal_kalibrasi,
    //             'tempatKalibrasi' => $request->tempat_kalibrasi,
    //             'kondisiAlat' => $request->fungsi_komponen,
    //             'keterangan' => $request->keterangan_fungsi_komponen,
    //             'RT_condition1' => $request->suhu_awal,
    //             'RT_condition2' => $request->suhu_tengah,
    //             'RT_condition3' => $request->suhu_akhir,
    //             'RH_condition1' => $request->rh_awal,
    //             'RH_condition2' => $request->rh_tengah,
    //             'RH_condition3' => $request->rh_akhir,
    //             'calibratedBy' => $request->calibrated_by,
    //             'verifiedBy' => $request->verified_by,
    //             'jenisPembacaan' => $request->jenis_pembacaan,
    //             'lokasiPT' => $request->lokasi_pt,
    //         ];

    //         $calibration->update($calibrationData);

    //         // Tentukan jenis alat berdasarkan nama alat
    //         $formType = $this->getAlatType($calibration->namaAlat);
            
    //         \Log::info('🔧 Update form type detected:', ['type' => $formType]);

    //         // Panggil metode update spesifik berdasarkan nama alat
    //         switch($formType) {
    //             case 'inside_micrometer':
    //                 $this->updateInsideMicrometer($request, $calibration);
    //                 break;
    //             case 'outside_micrometer':
    //                 $this->updateOutsideMicrometer($request, $calibration);
    //                 break;
    //             case 'depth_micrometer':
    //                 $this->updateDepthMicrometer($request, $calibration);
    //                 break;
    //             case 'thermometer':
    //                 $this->updateThermometer($request, $calibration);
    //                 break;
    //             case 'dial_indicator':
    //                 $this->updateDialIndicator($request, $calibration);
    //                 break;
    //             case 'dial_test_indicator':
    //                 $this->updateDialTestIndicator($request, $calibration);
    //                 break;
    //             case 'depth_caliper':
    //                 $this->updateDepthCaliper($request, $calibration);
    //                 break;
    //             case 'caliper':
    //                 $this->updateCaliper($request, $calibration);
    //                 break;
    //             case 'torque_wrench':
    //                 $this->updateTorqueWrench($request, $calibration);
    //                 break;
    //             case 'torque_meter':
    //                 $this->updateTorqueMeter($request, $calibration);
    //                 break;
    //             case 'thickness_gauge':
    //                 $this->updateThicknessGauge($request, $calibration);
    //                 break;
    //             case 'penggaris':
    //                 $this->updatePenggaris($request, $calibration);
    //                 break;
    //             case 'enclosure':
    //                 $this->updateEnclosure($request, $calibration);
    //                 break;
    //             case 'chamber':
    //                 $this->updateClimaticChamber($request, $calibration);
    //                 break;
    //             case 'pressure_gauge':
    //                 $this->updatePressureGauge($request, $calibration);
    //                 break;
    //             case 'differential_pressure_gauge':
    //                 $this->updateDifferentialPressureGauge($request, $calibration);
    //                 break;
    //             case 'volumetrik':
    //                 $this->updateVolumetrik($request, $calibration);
    //                 break;
    //             case 'thermohygrometer':
    //                 $this->updateThermohygrometer($request, $calibration);
    //                 break;
    //             case 'viscometer':
    //                 $this->updateViscometer($request, $calibration);
    //                 break;
    //             case 'push_pull':
    //                 $this->updatePushPull($request, $calibration);
    //                 break;
    //             case 'timbangan':
    //                 $this->updateTimbangan($request, $calibration);
    //                 break;
    //             case 'timbangan_moisture':
    //                 $this->updateTimbanganMoisture($request, $calibration);
    //                 break;
    //             default:
    //                 \Log::warning('⚠️ Unknown form type for update:', ['type' => $formType]);
    //                 break;
    //         }

    //         \Log::info('✅ UPDATE COMPLETED SUCCESSFULLY');

    //         return redirect()->route('calibrations.index')
    //             ->with('success', 'Data kalibrasi berhasil diperbarui!');

    //     } catch (\Exception $e) {
    //         \Log::error('💥 UPDATE METHOD ERROR:', [
    //             'message' => $e->getMessage(),
    //             'file' => $e->getFile(),
    //             'line' => $e->getLine(),
    //             'trace' => $e->getTraceAsString()
    //         ]);
            
    //         return redirect()->back()
    //             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
    //             ->withInput();
    //     }
    // }


    
    public function destroy($id)
    {
        try {
            $calibration = Calibration::findOrFail($id);

            // Hapus data spesifik alat terlebih dahulu
            $this->deleteAlatSpecificData($calibration);

            // Jika alat surface_plate, hapus juga gambar canvas jika ada
            $alatType = $this->getAlatType($calibration->namaAlat);
            if ($alatType === 'surface_plate' && $calibration->headSurfacePlate) {
                $imgPath = $calibration->headSurfacePlate->keterangan ?? '';
                if ($imgPath && is_string($imgPath) && strpos($imgPath, 'img_SurfacePlate/') === 0) {
                    $fullPath = public_path($imgPath);
                    if (file_exists($fullPath)) {
                        @unlink($fullPath);
                        \Log::info('🗑️ Gambar surface_plate dihapus:', ['file' => $fullPath]);
                    }
                }
            }

            // Hapus calibration
            $calibration->delete();

            return redirect()->route('calibrations.index')
                ->with('success', 'Data kalibrasi berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('calibrations.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Hapus data spesifik berdasarkan jenis alat
     */
    private function deleteAlatSpecificData($calibration)
    {
        $alatType = $this->getAlatType($calibration->namaAlat);
        
        switch($alatType) {
            case 'inside_micrometer':
                if ($calibration->headInsideMicrometer) {
                    $calibration->headInsideMicrometer->details()->delete();
                    $calibration->headInsideMicrometer()->delete();
                }
                break;
                
            case 'outside_micrometer':
                if ($calibration->headOutsideMicrometer) {
                    $calibration->headOutsideMicrometer->details()->delete();
                    $calibration->headOutsideMicrometer()->delete();
                }
                if ($calibration->addOutsideMicrometer) {
                    $calibration->addOutsideMicrometer()->delete();
                }
                break;

            case 'depth_micrometer':
                if ($calibration->headDepthMicrometer) {
                    $calibration->headDepthMicrometer->details()->delete();
                    $calibration->headDepthMicrometer()->delete();                    
                }
                if ($calibration->addDepthMicrometer) {
                    $calibration->addDepthMicrometer()->delete();
                }
                break;

            case 'thermometer':
                if ($calibration->headThermometer) {
                    $calibration->headThermometer->details()->delete();
                    $calibration->headThermometer()->delete();                    
                }
                break;
                
            // Tambahkan case untuk alat lainnya
        }
    }

    private function autoCompleteRequiredColumns($data)
    {
        \Log::info('🛠️ START autoCompleteRequiredColumns (SIMPLIFIED)');
        
        // DEBUG: Log semua data input
        \Log::info('🔍 ALL INPUT DATA:', $data);
        
        // Daftar kolom required yang HARUS ada
        $requiredColumns = [
            'NIK',
            'namaAlat',
            'LK',
            'brandAlat',
            'kodeAlat',
            'typeAlat',
            'kapasitas',
            'resolusi',
            'rangeMin',
            'rangeMax',
            'pemilikAlat',
            'tanggalMasuk',
            'tanggalKalibrasi', // ✅ PASTIKAN INI ADA
            'tempatKalibrasi',
            'jenisPembacaan',
            'lokasiPT',
            'RT_condition1',
            'RT_condition2',
            'RT_condition3',
            'RH_condition1',
            'RH_condition2',
            'RH_condition3',
            'kondisiAlat',
            'keterangan',
            'status',
            'calibratedBy',
            'verifiedBy',
            'NoSeri'
        ];
        
        $completedData = $data;
        
        // Pastikan semua required columns ada
        foreach ($requiredColumns as $column) {
            if (!array_key_exists($column, $completedData) || 
                $completedData[$column] === null || 
                $completedData[$column] === '') {
                
                // Beri default value
                $defaultValue = $this->getSmartDefaultValue($column, $completedData);
                $completedData[$column] = $defaultValue;
                
                \Log::warning("⚠️ Set {$column} to default: {$defaultValue}");
            }
        }
        
        // LOG khusus untuk tanggalKalibrasi
        \Log::info('🔍 tanggalKalibrasi FINAL:', [
            'value' => $completedData['tanggalKalibrasi'],
            'exists' => isset($completedData['tanggalKalibrasi'])
        ]);
        
        \Log::info('🛠️ END autoCompleteRequiredColumns');
        
        return $completedData;
    }
    
    private function getSmartDefaultValue($column, $currentData)
    {
        // Default values berdasarkan nama kolom
        $defaults = [
            'tanggalKalibrasi' => $currentData['tanggalMasuk'] ?? now()->toDateString(),
            'tanggalMasuk' => now()->toDateString(),
            'status' => 'waiting_verification',
            'NIK' => auth()->user()->nik ?? 'admin',
            'calibratedBy' => auth()->user()->nama ?? 'Admin',
            'verifiedBy' => auth()->user()->nama ?? 'Admin',
            'kondisiAlat' => 'ok',
            'tempatKalibrasi' => 'laboratorium',
            'jenisPembacaan' => 'analog',
            'RT_condition1' => '23',
            'RT_condition2' => '23',
            'RT_condition3' => '23',
            'RH_condition1' => '60',
            'RH_condition2' => '60',
            'RH_condition3' => '60',
            'rangeMin' => '0',
            'rangeMax' => '100',
        ];
        
        return $defaults[$column] ?? '';
    }

    /**
     * Get calibration data for view modal
     */
    public function viewData($id)
    {
        try {
            $calibration = Calibration::with([
                'headInsideMicrometer',
                'detailInsideMicrometers',
                'headOutsideMicrometer',
                'detailOutsideMicrometers',
                'addOutsideMicrometer'
            ])->findOrFail($id);

            // Tentukan form type berdasarkan nama alat
            $formType = $this->getAlatType($calibration->namaAlat);
            
            // Return HTML untuk modal content
            return view('calibrations.modal-content', compact('calibration', 'formType'));
            
        } catch (\Exception $e) {
            \Log::error('Error loading calibration view data:', ['error' => $e->getMessage()]);
            return '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
        }
    }

    /**
     * Get form HTML untuk modal view berdasarkan jenis alat
     */
    // public function getFormView($id, $formType)
    // {
    //     try {
    //         $calibration = Calibration::with([
    //             'headInsideMicrometer',
    //             'detailInsideMicrometers',
    //             'headOutsideMicrometer',
    //             'detailOutsideMicrometers',
    //             'addOutsideMicrometer',
    //              'headIrThermometer',
    //             'detailIrThermometers',
    //             'addIrThermometer',
    //             'headThermometer',
    //             'detailThermometers',
    //             'headDialIndicator',
    //             'detailDialIndicators',
    //             'headDialTestIndicator',
    //             'detailDialTestIndicators',
    //             'headDepthCaliper',
    //             'detailDepthCalipers',
    //             'headCaliper',
    //             'detailCalipers',
    //             'headTorqueWrench',
    //             'detailTorqueWrenchs',
    //             'headTorqueMeter',
    //             'detailTorqueMeters',
    //             'headThicknessGauge',
    //             'detailThicknessGauges',
    //             'headPenggaris',
    //             'detailPenggariss',
    //             'headEnclosure',
    //             'detailEnclosures',
    //             'addEnclosures',
    //             'headChamber', 
    //             'detailChambers', 
    //             'addChamber',
    //             'headPressureGauge',
    //             'detailPressureGauges',
    //             'addPressureGauge',
    //             'headDifferentialPressureGauge',
    //             'detailDifferentialPressureGauges',
    //             'addDifferentialPressureGauge',
    //             'headVolumetrik',
    //             'detailVolumetriks',
    //             'addVolumetrik',
    //             'headTimbangan',
    //             'detailTimbangans',
    //             'addTimbangan',
    //             'headTimbanganMoisture',
    //             'detailTimbanganMoistures',
    //             'addTimbanganMoisture',
    //             'headTimbanganBias',
    //             'detailTimbanganBiass',
    //             'addTimbanganBias',
    //             'headGaugeBlock',
    //             'detailGaugeBlocks',
    //             'addGaugeBlock',
    //             'headHoletest',
    //             'detailHoletests',
    //             'headConductivityMeter',
    //             'detailConductivityMeters',
    //             'headCoatingThickness',
    //             'detailCoatingThicknesses',
    //             'headDurometer',
    //             'detailDurometers',
    //             'addDurometer',
    //             'headMikropipetDispenset',
    //             'detailMikropipetDispensets',
    //             'headTaperGauge',
    //             'detailTaperGauges',
    //             'headFeelerGauge',
    //             'detailFeelerGauges',
    //             'headPhMeter',
    //             'detailPhMeters',
    //             'headTachometer',
    //             'detailTachometers',
    //             'headPinGauge',
    //             'detailPinGauges',
    //             'headViscoCup',
    //             'detailViscoCups',
    //             'headTempHumidTransmitter',
    //             'detail_T_TempHumidTransmitters',
    //             'detail_RH_TempHumidTransmitters',
    //             'headTempTransmitter',
    //             'detailTempTransmitters',
    //             'headThermoIndicator',
    //             'detailThermoIndicators',
    //             'addThermoIndicator',
    //             'headPlasticShim',
    //             'detailPlasticShims',
    //             'headSurfaceRoughnessTester',
    //             'detailSurfaceRoughnessTesters',
    //         ])->findOrFail($id);

    //         // Render form HTML yang sesuai
    //         switch($formType) {
    //             case 'inside_micrometer':
    //                 return view('formhtml.inside_micrometer_view', compact('calibration'));
    //             case 'outside_micrometer':
    //                 return view('formhtml.outside_micrometer_view', compact('calibration'));
    //             case 'depth_micrometer':
    //                 return view('formhtml.depth_micrometer_view', compact('calibration'));
    //             case 'ir_thermometer':
    //                 \Log::info('📄 Using ir_thermometer_view');
    //                 return view('formhtml.thermometer_infrared_view', compact('calibration'));
    //             case 'thermometer':
    //                 return view('formhtml.thermometer_view', compact('calibration'));
    //             case 'dial_indicator':
    //                 return view('formhtml.dial_indicator_view', compact('calibration'));
    //             case 'dial_test_indicator':
    //                 return view('formhtml.dial_test_indicator_view', compact('calibration'));
    //             case 'depth_caliper':
    //                 return view('formhtml.depth_caliper_view', compact('calibration'));
    //             case 'caliper':
    //                 return view('formhtml.caliper_view', compact('calibration'));
    //             case 'torque_wrench':
    //                 return view('formhtml.torque_wrench_view', compact('calibration'));
    //             case 'torque_meter':
    //                 return view('formhtml.torque_meter_view', compact('calibration'));
    //             case 'thickness_gauge':
    //                 return view('formhtml.thickness_gauge_view', compact('calibration'));
    //             case 'penggaris':
    //                 return view('formhtml.penggaris_view', compact('calibration'));
    //             case 'enclosure':
    //                 return view('formhtml.enclosure_view', compact('calibration'));
    //             case 'chamber':
    //                 return view('formhtml.chamber_view', compact('calibration'));
    //             case 'pressure_gauge':
    //                 return view('formhtml.pressure_gauge_view', compact('calibration'));

    //             case 'differential_pressure_gauge':
    //                 return view('formhtml.differential_pressure_gauge_view', compact('calibration'));

    //             case 'volumetrik':
    //                 return view('formhtml.volumetrik_view', compact('calibration'));

    //             case 'feeler_gauge':
    //                 return view('formhtml.feeler_gauge_view', compact('calibration'));
                    
    //             case 'push_pull':
    //                 return view('formhtml.push_pull_view', compact('calibration'));
  
    //             case 'timbangan_moisture':
    //                 \Log::info('📄 Using timbangan_moisture_view (moisture)');
    //                 return view('formhtml.timbangan_moisture_view', compact('calibration'));
                    
    //             case 'timbangan_bias':
    //                 \Log::info('📄 Using timbangan_bias_view');
    //                 return view('formhtml.timbangan_bias_view', compact('calibration'));

    //             case 'timbangan':
    //                 \Log::info('📄 Using timbangan_view (standard)');
    //                 return view('formhtml.timbangan_view', compact('calibration'));

    //             case 'gauge_block':
    //                 \Log::info('📄 Using gauge_block_view');
    //                 return view('formhtml.gauge_block_view', compact('calibration'));

    //             case 'holetest':
    //                 \Log::info('📄 Using holetest_view');
    //                 return view('formhtml.holetest_view', compact('calibration'));

    //             case 'conductivity meter':
    //                 \Log::info('📄 Using conductivity_meter_view');
    //                 return view('formhtml.conductivity_meter_view', compact('calibration'));

    //             case 'coating_thickness':
    //                 \Log::info('📄 Using coating_thickness_view');
    //                 return view('formhtml.coating_thickness_view', compact('calibration'));

    //             case 'durometer':
    //                 \Log::info('📄 Using durometer_view');
    //                 return view('formhtml.durometer_view', compact('calibration'));

    //             case 'Mikropipet Dispenset':
    //                 \Log::info('📄 Using mikropipet_dispenset_view');
    //                 return view('formhtml.mikropipet_dispenset_view', compact('calibration'));

    //             case 'taper_gauge':
    //                 \Log::info('📄 Using taper_gauge_view');
    //                 return view('formhtml.taper_gauge_view', compact('calibration'));

    //             case 'ph_meter':
    //                 \Log::info('📄 Using ph_meter_view');
    //                 return view('formhtml.ph_meter_view', compact('calibration'));

    //             case 'tachometer':
    //                 \Log::info('📄 Using tachometer_view');
    //                 return view('formhtml.tachometer_view', compact('calibration'));

    //             case 'pin_gauge':
    //                 \Log::info('📄 Using pin_gauge_view');
    //                 return view('formhtml.pin_gauge_view', compact('calibration'));

    //             case 'visco_cup':
    //                 \Log::info('📄 Using visco_cup_view');
    //                 return view('formhtml.visco_cup_view', compact('calibration'));

    //             case 'temp_humid_transmitter':
    //                 \Log::info('📄 Using temp_humid_transmitter_view');
    //                 return view('formhtml.temp_humid_transmitter_view', compact('calibration'));

    //             case 'temp_transmitter':
    //                 \Log::info('📄 Using temp_transmitter');
    //                 return view('formhtml.temp_transmitter_view', compact('calibration'));

    //             case 'thermoindicator':
    //                 \Log::info('📄 Using thermoindicator_view');
    //                 return view('formhtml.thermoindicator_view', compact('calibration'));

    //             case 'plastic_shim':
    //                 \Log::info('📄 Using plastic_shim_view');
    //                 return view('formhtml.plastic_shim_view', compact('calibration'));
                    


    //             // Tambahkan case untuk alat lainnya
    //             default:
    //                 return view('formhtml.general_view', compact('calibration'));
    //         }
            
    //     } catch (\Exception $e) {
    //         \Log::error('Error loading form view:', ['error' => $e->getMessage()]);
    //         return '<div class="alert alert-danger">Gagal memuat form: ' . $e->getMessage() . '</div>';
    //     }
    // }

    
       

    public function markAsVerified($id)
    {
        try {
            $calibration = Calibration::findOrFail($id);
            $userName = auth()->user()->nama;

            // Update status dan status_transaction sesuai workflow
            $calibration->update([
                'status' => 'verified',
                'status_transaction' => "Data telah diverifikasi oleh {$userName} dan siap untuk approval",
                'verifiedBy' => $userName,
                'verified' => now()
            ]);

            \Log::info("✅ Data verified", [
                'calibration_id' => $id,
                'by' => $userName
            ]);

            return redirect()->route('calibrations.index')
                ->with('success', "Data berhasil diverifikasi oleh {$userName}");

        } catch (\Exception $e) {
            \Log::error('💥 Error verifying data:', ['error' => $e->getMessage()]);
            return redirect()->route('calibrations.index')
                ->with('error', 'Gagal memverifikasi data: ' . $e->getMessage());
        }
    }


    public function markAsApproved($id)
    {
        try {
            $calibration = Calibration::findOrFail($id);
            $userName = auth()->user()->nama;

            // Update status dan status_transaction sesuai workflow
            $calibration->update([
                'status' => 'approved',
                'status_transaction' => "Data telah disetujui oleh {$userName} dan proses kalibrasi selesai",
                'approvedBy' => $userName,
                'approved' => now()
            ]);

            \Log::info("✅ Data approved", [
                'calibration_id' => $id,
                'by' => $userName
            ]);

            return redirect()->route('calibrations.index')
                ->with('success', "Data berhasil disetujui oleh {$userName}");

        } catch (\Exception $e) {
            \Log::error('💥 Error approving data:', ['error' => $e->getMessage()]);
            return redirect()->route('calibrations.index')
                ->with('error', 'Gagal menyetujui data: ' . $e->getMessage());
        }
    }

    
    public function markAsRejected(Request $request, $id)
    {
        try {
            $request->validate([
                'rejection_reason' => 'required|string|max:500'
            ]);

            $calibration = Calibration::findOrFail($id);
            $userName = auth()->user()->nama;
            $reason = $request->rejection_reason;

            // Update status dan status_transaction sesuai workflow
            $calibration->update([
                'status' => 'rejected',
                'status_transaction' => "Data ditolak oleh {$userName}. Alasan: {$reason}",
                'verifiedBy' => $userName, // Orang yang menolak
                'verified' => now()
            ]);

            \Log::info("❌ Data rejected", [
                'calibration_id' => $id,
                'by' => $userName,
                'reason' => $reason
            ]);

            return redirect()->route('calibrations.index')
                ->with('success', "Data berhasil ditolak oleh {$userName}");

        } catch (\Exception $e) {
            \Log::error('💥 Error rejecting data:', ['error' => $e->getMessage()]);
            return redirect()->route('calibrations.index')
                ->with('error', 'Gagal menolak data: ' . $e->getMessage());
        }
    }

            /**
         * Verify calibration - SESUAI MODEL
         */
        public function verify($id)
        {
            try {
                $calibration = Calibration::findOrFail($id);
                $userName = auth()->user()->nama;

                // ✅ SESUAI MODEL: Gunakan method dari model
                $calibration->markAsVerified($userName, 'Data telah diverifikasi dan siap untuk approval');

                \Log::info("✅ Data verified", [
                    'calibration_id' => $id,
                    'by' => $userName
                ]);

                return redirect()->route('calibrations.index')
                    ->with('success', "Data berhasil diverifikasi oleh {$userName}");

            } catch (\Exception $e) {
                \Log::error('💥 Error verifying data:', ['error' => $e->getMessage()]);
                return redirect()->route('calibrations.index')
                    ->with('error', 'Gagal memverifikasi data: ' . $e->getMessage());
            }
        }

        /**
         * Approve calibration - SESUAI MODEL
         */
        public function approve($id)
        {
            try {
                $calibration = Calibration::findOrFail($id);
                $userName = auth()->user()->nama;

                // ✅ SESUAI MODEL: Gunakan method dari model
                $calibration->markAsApproved($userName, 'Data telah disetujui');

                \Log::info("✅ Data approved", [
                    'calibration_id' => $id,
                    'by' => $userName
                ]);

                return redirect()->route('calibrations.index')
                    ->with('success', "Data berhasil disetujui oleh {$userName}");

            } catch (\Exception $e) {
                \Log::error('💥 Error approving data:', ['error' => $e->getMessage()]);
                return redirect()->route('calibrations.index')
                    ->with('error', 'Gagal menyetujui data: ' . $e->getMessage());
            }
        }

        /**
         * Reject calibration - SESUAI MODEL
         */
        public function reject(Request $request, $id)
        {
            try {
                $request->validate([
                    'rejection_reason' => 'required|string|max:500'
                ]);

                $calibration = Calibration::findOrFail($id);
                $userName = auth()->user()->nama;
                $reason = $request->rejection_reason;

                // ✅ SESUAI MODEL: Gunakan method dari model
                $calibration->markAsRejected($userName, $reason, 'Verifier');

                \Log::info("❌ Data rejected", [
                    'calibration_id' => $id,
                    'by' => $userName,
                    'reason' => $reason
                ]);

                return redirect()->route('calibrations.index')
                    ->with('success', "Data berhasil ditolak oleh {$userName}");

            } catch (\Exception $e) {
                \Log::error('💥 Error rejecting data:', ['error' => $e->getMessage()]);
                return redirect()->route('calibrations.index')
                    ->with('error', 'Gagal menolak data: ' . $e->getMessage());
            }
        }

        /**
         * Complete calibration - SESUAI MODEL
         */
        public function complete($id)
        {
            try {
                $calibration = Calibration::findOrFail($id);
                $userName = auth()->user()->nama;

                // ✅ SESUAI MODEL: Gunakan method dari model
                $calibration->markAsCompleted($userName, 'Proses kalibrasi selesai');

                \Log::info("✅ Data completed", [
                    'calibration_id' => $id,
                    'by' => $userName
                ]);

                return redirect()->route('calibrations.index')
                    ->with('success', "Proses kalibrasi telah diselesaikan oleh {$userName}");

            } catch (\Exception $e) {
                \Log::error('💥 Error completing data:', ['error' => $e->getMessage()]);
                return redirect()->route('calibrations.index')
                    ->with('error', 'Gagal menyelesaikan proses: ' . $e->getMessage());
            }
        }

            public function downloadExcelTemplate($id)
            {
                try {
                    \Log::info('🟢 ===== START EXCEL DOWNLOAD WITH TEMPLATE =====');

                    // Load relasi yang diperlukan
                    $calibration = Calibration::with([
                        'headInsideMicrometer',
                        'detailInsideMicrometers',
                        'headOutsideMicrometer',
                        'detailOutsideMicrometers',
                        'addOutsideMicrometer',
                        'headDepthMicrometer',
                        'detailDepthMicrometers',
                        'headThermometer',
                        'detailThermometers',
                    ])->findOrFail($id);

                    \Log::info('🔧 Instrument: ' . $calibration->namaAlat);

                    // Tentukan jenis alat dan template yang sesuai
                    $templateFile = null;
                    $fillFunction = null;

                    if ($calibration->headInsideMicrometer !== null) {
                        $templateFile = 'template_inside_micrometer.xlsm';
                        $fillFunction = 'fillInsideMicrometerExcel';
                    } 
                    elseif ($calibration->headOutsideMicrometer !== null) {
                        $templateFile = 'template_outside_micrometer.xlsm';
                        $fillFunction = 'fillOutsideMicrometerExcel';
                    }
                    elseif ($calibration->headDepthMicrometer !== null) {
                        $templateFile = 'template_depth_micrometer.xlsm';
                        $fillFunction = 'fillDepthMicrometerExcel';
                    }
                    elseif ($calibration->headThermometer !== null) {
                        $templateFile = 'template_thermometer.xlsm';
                        $fillFunction = 'fillThermometerExcel';
                           // DEBUG: Log template yang dipilih
                    \Log::info('📋 Template dipilih: ' . $templateFile);
                    }

                    if (!$templateFile || !$fillFunction) {
                        throw new \Exception('Template Excel belum tersedia untuk alat ini.');
                    }

                    $templatePath = public_path('excel_files/' . $templateFile);

                    if (!file_exists($templatePath)) {
                        throw new \Exception('File template tidak ditemukan: ' . $templateFile);
                    }

                    // Generate nama file
                    $fileName = $this->generateFileName($calibration);
                    $tempPath = storage_path('app/temp/' . $fileName);

                    // Buat folder temp jika belum ada
                    if (!is_dir(dirname($tempPath))) {
                        mkdir(dirname($tempPath), 0755, true);
                    }

                    // Copy template
                    if (!copy($templatePath, $tempPath)) {
                        throw new \Exception('Gagal menyalin template Excel');
                    }

                    \Log::info('✅ Template copied to: ' . $tempPath);

                    // Panggil fungsi pengisian data yang sesuai
                    $this->{$fillFunction}($tempPath, $calibration);

                    \Log::info('✅ Data berhasil diisi ke Excel');

                    // Pastikan tidak ada output sebelum headers
                   ob_end_clean();  // membersihkan output buffer 

                    return response()->download($tempPath, $fileName, [
                    'Content-Type' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                ])->deleteFileAfterSend(true);

                } catch (\Exception $e) {
                    \Log::error('💥 ERROR DOWNLOAD EXCEL: ' . $e->getMessage());
                      // Pastikan tidak mengembalikan view/redirect jika sudah ada output
                    if (ob_get_length()) ob_clean();
                    
                    return back()->with('error', 'Gagal download template: ' . $e->getMessage());
                }
            }
        
        
        public function fillInsideMicrometerExcel($filePath, $calibration)
        {
            try {
                \Log::info('Mengisi data Excel untuk Inside Micrometer');

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $sheet = $spreadsheet->getSheetByName('ACTION');

                if (!$sheet) {
                    throw new \Exception("Sheet 'ACTION' tidak ditemukan di template Inside Micrometer");
                }

                // === DATA UMUM DARI TABEL CALIBRATION ===
                $sheet->setCellValue('B1',  $calibration->id ?? '');
                $sheet->setCellValue('B2',  $calibration->namaAlat ?? '');
                $sheet->setCellValue('B3',  $calibration->brandAlat ?? '');
                $sheet->setCellValue('B5',  $calibration->typeAlat ?? '');
                $sheet->setCellValue('B6',  $calibration->NoSeri ?? '');
                $sheet->setCellValue('B4',  $calibration->kodeAlat ?? '');
                $sheet->setCellValue('B9',  $calibration->kapasitas ?? '');
                $sheet->setCellValue('B10', $calibration->resolusi ?? '');
                $sheet->setCellValue('B7',  $calibration->rangeMin ?? '');
                $sheet->setCellValue('B8',  $calibration->rangeMax ?? '');
                $sheet->setCellValue('B18', $calibration->keterangan ?? '');
                $sheet->setCellValue('B17', $calibration->kondisiAlat ?? '');

                $sheet->setCellValue('B12', $calibration->tanggalMasuk ? date('d-m-Y', strtotime($calibration->tanggalMasuk)) : '');
                $sheet->setCellValue('B13', $calibration->tanggalKalibrasi ? date('d-m-Y', strtotime($calibration->tanggalKalibrasi)) : '');

                $sheet->setCellValue('B15', $calibration->tempatKalibrasi ?? '');
                $sheet->setCellValue('B14', $calibration->jenisPembacaan ?? '');
                $sheet->setCellValue('B11', $calibration->pemilikAlat ?? '');
                $sheet->setCellValue('B16', $calibration->lokasiPT ?? '');

                // Suhu & RH
                $sheet->setCellValue('B22', $calibration->RT_condition1 ?? '');
                $sheet->setCellValue('C22', $calibration->RT_condition2 ?? '');
                $sheet->setCellValue('D22', $calibration->RT_condition3 ?? '');
                $sheet->setCellValue('B23', $calibration->RH_condition1 ?? '');
                $sheet->setCellValue('C23', $calibration->RH_condition2 ?? '');
                $sheet->setCellValue('D23', $calibration->RH_condition3 ?? '');

                // Calibrated & Verified by
                $sheet->setCellValue('B45', $calibration->calibratedBy ?? '');
                $sheet->setCellValue('B46', $calibration->verifiedBy ?? '');

                // === HEAD DATA KHUSUS INSIDE MICROMETER ===
                if ($calibration->headInsideMicrometer) {
                    $head = $calibration->headInsideMicrometer;
                    $sheet->setCellValue('B43', $head->standard ?? '');
                    $sheet->setCellValue('B44', $head->calibrationMethod ?? '');
                    // Tambahkan field lain dari headInsideMicrometer jika ada
                }

                // === DETAIL DATA (baris mulai 27) ===
                if ($calibration->detailInsideMicrometers && $calibration->detailInsideMicrometers->count() > 0) {
                    $row = 27;
                    foreach ($calibration->detailInsideMicrometers as $index => $detail) {
                        if ($index >= 20) break; // batas maksimal sesuai template

                        $sheet->setCellValue('A' . $row, $detail->titikUkur ?? '');
                        $sheet->setCellValue('B' . $row, $detail->ulangan01 ?? '');
                        $sheet->setCellValue('C' . $row, $detail->ulangan02 ?? '');
                        $sheet->setCellValue('D' . $row, $detail->ulangan03 ?? '');
                        $sheet->setCellValue('E' . $row, $detail->ulangan04 ?? '');
                        $sheet->setCellValue('F' . $row, $detail->ulangan05 ?? '');

                        $row++;
                    }
                }

                // === OPTIMASI UNTUK PRESERVE MACRO ===
                $spreadsheet->setActiveSheetIndex(0);
                $spreadsheet->garbageCollect();

                $calculationEngine = \PhpOffice\PhpSpreadsheet\Calculation\Calculation::getInstance($spreadsheet);
                $calculationEngine->setCalculationCacheEnabled(false);
                $calculationEngine->clearCalculationCache();

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->setPreCalculateFormulas(false);
                $writer->save($filePath);

                \Log::info('SUKSES! Data Inside Micrometer berhasil diisi ke Excel');

            } catch (\Exception $e) {
                \Log::error('Error fillInsideMicrometerExcel: ' . $e->getMessage());
                throw $e;
            }
        }
        
            public function fillOutsideMicrometerExcel($filePath, $calibration)
            {
            try {
                \Log::info('Mengisi data Excel untuk Outside Micrometer (menggunakan addOutsideMicrometer)');

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $sheet = $spreadsheet->getSheetByName('ACTION');

                if (!$sheet) {
                    throw new \Exception("Sheet 'ACTION' tidak ditemukan di template Outside Micrometer");
                }

                // === DATA UMUM (sama untuk semua alat) ===
                $sheet->setCellValue('B1',  $calibration->id ?? '');
                $sheet->setCellValue('B2',  $calibration->namaAlat ?? '');
                $sheet->setCellValue('B3',  $calibration->brandAlat ?? '');
                $sheet->setCellValue('B5',  $calibration->typeAlat ?? '');
                $sheet->setCellValue('B6',  $calibration->NoSeri ?? '');
                $sheet->setCellValue('B4',  $calibration->kodeAlat ?? '');
                $sheet->setCellValue('B9',  $calibration->kapasitas ?? '');
                $sheet->setCellValue('B10', $calibration->resolusi ?? '');
                $sheet->setCellValue('B7',  $calibration->rangeMin ?? '');
                $sheet->setCellValue('B8',  $calibration->rangeMax ?? '');
                $sheet->setCellValue('B18', $calibration->keterangan ?? '');
                $sheet->setCellValue('B17', $calibration->kondisiAlat ?? '');

                $sheet->setCellValue('B12', $calibration->tanggalMasuk ? date('d-m-Y', strtotime($calibration->tanggalMasuk)) : '');
                $sheet->setCellValue('B13', $calibration->tanggalKalibrasi ? date('d-m-Y', strtotime($calibration->tanggalKalibrasi)) : '');

                $sheet->setCellValue('B15', $calibration->tempatKalibrasi ?? '');
                $sheet->setCellValue('B14', $calibration->jenisPembacaan ?? '');
                $sheet->setCellValue('B11', $calibration->pemilikAlat ?? '');
                $sheet->setCellValue('B16', $calibration->lokasiPT ?? '');

                // Suhu & Kelembaban
                $sheet->setCellValue('B22', $calibration->RT_condition1 ?? '');
                $sheet->setCellValue('C22', $calibration->RT_condition2 ?? '');
                $sheet->setCellValue('D22', $calibration->RT_condition3 ?? '');
                $sheet->setCellValue('B23', $calibration->RH_condition1 ?? '');
                $sheet->setCellValue('C23', $calibration->RH_condition2 ?? '');
                $sheet->setCellValue('D23', $calibration->RH_condition3 ?? '');

                // Calibrated & Verified by
                $sheet->setCellValue('B45', $calibration->calibratedBy ?? '');
                $sheet->setCellValue('B46', $calibration->verifiedBy ?? '');
                $sheet->setCellValue('A52', $calibration->addOutsideMicrometer->ukuranAnvil1 ?? '');
                $sheet->setCellValue('B52', $calibration->addOutsideMicrometer->jumlahAnvil1 ?? '');
                $sheet->setCellValue('C52', $calibration->addOutsideMicrometer->ukuranSpindle1 ?? '');
                $sheet->setCellValue('D52', $calibration->addOutsideMicrometer->jumlahSpindle1 ?? '');

                    // Baris 53: Anvil 2 & Spindle 2
                $sheet->setCellValue('A53', $calibration->addOutsideMicrometer->ukuranAnvil2 ?? '');
                $sheet->setCellValue('B53', $calibration->addOutsideMicrometer->jumlahAnvil2 ?? '');
                $sheet->setCellValue('C53', $calibration->addOutsideMicrometer->ukuranSpindle2 ?? '');
                $sheet->setCellValue('D53', $calibration->addOutsideMicrometer->jumlahSpindle2 ?? '');
            

                // === HEAD DATA ===
                if ($calibration->headOutsideMicrometer) {
                    $head = $calibration->headOutsideMicrometer;
                    $sheet->setCellValue('B43', $head->standard ?? '');
                    $sheet->setCellValue('B44', $head->calibrationMethod ?? '');
                    // tambahkan field lain jika ada
                }

                // === DETAIL DATA (baris mulai 27) ===
                // Jika masih digunakan (misal untuk pengukuran utama)
                if ($calibration->detailOutsideMicrometers && $calibration->detailOutsideMicrometers->count() > 0) {
                    $row = 27;
                    foreach ($calibration->detailOutsideMicrometers as $index => $detail) {
                        if ($index >= 20) break;

                        $sheet->setCellValue('A' . $row, $detail->titikUkur ?? '');
                        $sheet->setCellValue('B' . $row, $detail->ulangan01 ?? '');
                        $sheet->setCellValue('C' . $row, $detail->ulangan02 ?? '');
                        $sheet->setCellValue('D' . $row, $detail->ulangan03 ?? '');
                        $sheet->setCellValue('E' . $row, $detail->ulangan04 ?? '');
                        $sheet->setCellValue('F' . $row, $detail->ulangan05 ?? '');

                        $row++;
                    }
                }

                

                // === OPTIMASI PRESERVE MACRO ===
                $spreadsheet->setActiveSheetIndex(0);
                $spreadsheet->garbageCollect();

                $calculationEngine = \PhpOffice\PhpSpreadsheet\Calculation\Calculation::getInstance($spreadsheet);
                $calculationEngine->setCalculationCacheEnabled(false);
                $calculationEngine->clearCalculationCache();

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->setPreCalculateFormulas(false);
                $writer->save($filePath);

                \Log::info('SUKSES! Data Outside Micrometer berhasil diisi ke Excel');

            } catch (\Exception $e) {
                \Log::error('Error fillOutsideMicrometerExcel: ' . $e->getMessage());
                throw $e;
            }
        }

        public function fillDepthMicrometerExcel($filePath, $calibration)
        {
            try {
                \Log::info('Mengisi data Excel untuk Depth Micrometer');

                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $sheet = $spreadsheet->getSheetByName('ACTION');

                if (!$sheet) {
                    throw new \Exception("Sheet 'ACTION' tidak ditemukan di template Depth Micrometer");
                }

                // === DATA UMUM DARI TABEL CALIBRATION ===
                $sheet->setCellValue('B1',  $calibration->id ?? '');
                $sheet->setCellValue('B2',  $calibration->namaAlat ?? '');
                $sheet->setCellValue('B3',  $calibration->brandAlat ?? '');
                $sheet->setCellValue('B5',  $calibration->typeAlat ?? '');
                $sheet->setCellValue('B6',  $calibration->NoSeri ?? '');
                $sheet->setCellValue('B4',  $calibration->kodeAlat ?? '');
                $sheet->setCellValue('B9',  $calibration->kapasitas ?? '');
                $sheet->setCellValue('B10', $calibration->resolusi ?? '');
                $sheet->setCellValue('B7',  $calibration->rangeMin ?? '');
                $sheet->setCellValue('B8',  $calibration->rangeMax ?? '');
                $sheet->setCellValue('B18', $calibration->keterangan ?? '');
                $sheet->setCellValue('B17', $calibration->kondisiAlat ?? '');

                $sheet->setCellValue('B12', $calibration->tanggalMasuk ? date('d-m-Y', strtotime($calibration->tanggalMasuk)) : '');
                $sheet->setCellValue('B13', $calibration->tanggalKalibrasi ? date('d-m-Y', strtotime($calibration->tanggalKalibrasi)) : '');

                $sheet->setCellValue('B15', $calibration->tempatKalibrasi ?? '');
                $sheet->setCellValue('B14', $calibration->jenisPembacaan ?? '');
                $sheet->setCellValue('B11', $calibration->pemilikAlat ?? '');
                $sheet->setCellValue('B16', $calibration->lokasiPT ?? '');

                // Suhu & RH
                $sheet->setCellValue('B22', $calibration->RT_condition1 ?? '');
                $sheet->setCellValue('C22', $calibration->RT_condition2 ?? '');
                $sheet->setCellValue('D22', $calibration->RT_condition3 ?? '');
                $sheet->setCellValue('B23', $calibration->RH_condition1 ?? '');
                $sheet->setCellValue('C23', $calibration->RH_condition2 ?? '');
                $sheet->setCellValue('D23', $calibration->RH_condition3 ?? '');

                // Calibrated & Verified by
                $sheet->setCellValue('B45', $calibration->calibratedBy ?? '');
                $sheet->setCellValue('B46', $calibration->verifiedBy ?? '');

                // === HEAD DATA KHUSUS DEPTH MICROMETER ===
                if ($calibration->headDepthMicrometer) {
                    $head = $calibration->headDepthMicrometer;
                    $sheet->setCellValue('B43', $head->standard ?? '');
                    $sheet->setCellValue('B44', $head->calibrationMethod ?? '');
                    // Tambahkan field lain dari headDepthMicrometer jika ada
                }

                // === DETAIL DATA (baris mulai 27) ===
                if ($calibration->detailDepthMicrometers && $calibration->detailDepthMicrometers->count() > 0) {
                    $row = 27;
                    foreach ($calibration->detailDepthMicrometers as $index => $detail) {
                        if ($index >= 20) break; // batas maksimal sesuai template

                        $sheet->setCellValue('A' . $row, $detail->titikUkur ?? '');
                        $sheet->setCellValue('B' . $row, $detail->ulangan01 ?? '');
                        $sheet->setCellValue('C' . $row, $detail->ulangan02 ?? '');
                        $sheet->setCellValue('D' . $row, $detail->ulangan03 ?? '');
                        $sheet->setCellValue('E' . $row, $detail->ulangan04 ?? '');
                        $sheet->setCellValue('F' . $row, $detail->ulangan05 ?? '');

                        $row++;
                    }
                }

                // === OPTIMASI UNTUK PRESERVE MACRO ===
                $spreadsheet->setActiveSheetIndex(0);
                $spreadsheet->garbageCollect();

                $calculationEngine = \PhpOffice\PhpSpreadsheet\Calculation\Calculation::getInstance($spreadsheet);
                $calculationEngine->setCalculationCacheEnabled(false);
                $calculationEngine->clearCalculationCache();

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->setPreCalculateFormulas(false);
                $writer->save($filePath);

                \Log::info('SUKSES! Data Depth Micrometer berhasil diisi ke Excel');

            } catch (\Exception $e) {
                \Log::error('Error fillDepthMicrometerExcel: ' . $e->getMessage());
                throw $e;
            }
        }


       public function fillThermometerExcel($filePath, $calibration)
{
    try {
        \Log::info('Mengisi data Excel untuk Thermometer');

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
        $sheet = $spreadsheet->getSheetByName('ACTION');

        if (!$sheet) {
            throw new \Exception("Sheet 'ACTION' tidak ditemukan di template Thermometer");
        }

        // === DATA UMUM DARI TABEL CALIBRATION ===
        $sheet->setCellValue('B1',  $calibration->id ?? '');
        $sheet->setCellValue('B2',  $calibration->namaAlat ?? '');
        $sheet->setCellValue('B3',  $calibration->brandAlat ?? '');
        $sheet->setCellValue('B5',  $calibration->typeAlat ?? '');
        $sheet->setCellValue('B6',  $calibration->NoSeri ?? '');
        $sheet->setCellValue('B4',  $calibration->kodeAlat ?? '');
        $sheet->setCellValue('B9',  $calibration->kapasitas ?? '');
        $sheet->setCellValue('B10', $calibration->resolusi ?? '');
        $sheet->setCellValue('B7',  $calibration->rangeMin ?? '');
        $sheet->setCellValue('B8',  $calibration->rangeMax ?? '');
        $sheet->setCellValue('B18', $calibration->keterangan ?? '');
        $sheet->setCellValue('B17', $calibration->kondisiAlat ?? '');

        $sheet->setCellValue('B12', $calibration->tanggalMasuk ? date('d-m-Y', strtotime($calibration->tanggalMasuk)) : '');
        $sheet->setCellValue('B13', $calibration->tanggalKalibrasi ? date('d-m-Y', strtotime($calibration->tanggalKalibrasi)) : '');

        $sheet->setCellValue('B15', $calibration->tempatKalibrasi ?? '');
        $sheet->setCellValue('B14', $calibration->jenisPembacaan ?? '');
        $sheet->setCellValue('B11', $calibration->pemilikAlat ?? '');
        $sheet->setCellValue('B16', $calibration->lokasiPT ?? '');

        // Suhu & RH
        $sheet->setCellValue('B22', $calibration->RT_condition1 ?? '');
        $sheet->setCellValue('C22', $calibration->RT_condition2 ?? '');
        $sheet->setCellValue('D22', $calibration->RT_condition3 ?? '');
        $sheet->setCellValue('B23', $calibration->RH_condition1 ?? '');
        $sheet->setCellValue('C23', $calibration->RH_condition2 ?? '');
        $sheet->setCellValue('D23', $calibration->RH_condition3 ?? '');

        // Calibrated & Verified by
        $sheet->setCellValue('B67', $calibration->calibratedBy ?? '');
        $sheet->setCellValue('B68', $calibration->verifiedBy ?? '');

        // === HEAD DATA KHUSUS THERMOMETER ===
        if ($calibration->headThermometer) {
            $head = $calibration->headThermometer;
            $sheet->setCellValue('B65', $head->standard ?? '');
            $sheet->setCellValue('B66', $head->calibrationMethod ?? '');
        }

        // === DETAIL DATA (mulai baris 28, loncat 3 baris per titik ukur) ===
        if ($calibration->detailThermometers && $calibration->detailThermometers->count() > 0) {
            $row = 28;
            
            foreach ($calibration->detailThermometers as $index => $detail) {
                if ($index >= 12) break;
                
                $sheet->setCellValue('A' . $row, $detail->titikUkur ?? '');
                $sheet->setCellValue('B' . $row, $detail->STD01 ?? '');
                $sheet->setCellValue('C' . $row, $detail->UUT01 ?? '');
                
                $sheet->setCellValue('A' . ($row + 1), '');
                $sheet->setCellValue('B' . ($row + 1), $detail->STD02 ?? '');
                $sheet->setCellValue('C' . ($row + 1), $detail->UUT02 ?? '');
                
                $sheet->setCellValue('A' . ($row + 2), '');
                $sheet->setCellValue('B' . ($row + 2), $detail->STD03 ?? '');
                $sheet->setCellValue('C' . ($row + 2), $detail->UUT03 ?? '');
                
                $row += 3;
            }
        }

             // === OPTIMASI UNTUK PRESERVE MACRO ===
                $spreadsheet->setActiveSheetIndex(0);
                $spreadsheet->garbageCollect();

                $calculationEngine = \PhpOffice\PhpSpreadsheet\Calculation\Calculation::getInstance($spreadsheet);
                $calculationEngine->setCalculationCacheEnabled(false);
                $calculationEngine->clearCalculationCache();

                $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                $writer->setPreCalculateFormulas(false);
                $writer->save($filePath);

                \Log::info('SUKSES! Data thermometer berhasil diisi ke Excel');

    } catch (\Exception $e) {
        \Log::error('Error fillThermometerExcel: ' . $e->getMessage());
        throw $e;
    }
}


        /**
         * Download file Excel yang sudah diverifikasi (untuk Approval)
         */
        public function downloadVerified($id)
        {
            try {
                \Log::info('🟢 ===== START DOWNLOAD FILE VERIFIED (APPROVAL) =====');

                // 1. Ambil data calibration
                $calibration = Calibration::findOrFail($id);

                // Validasi status harus 'verified'
                if ($calibration->status !== 'verified') {
                    \Log::warning("Attempt to download verified file but status is: " . $calibration->status);
                    return back()->with('error', 'File hanya bisa di-download saat status Terverifikasi.');
                }

                // Validasi location_data tidak boleh kosong
                if (empty($calibration->location_data)) {
                    \Log::error("location_data kosong untuk ID: " . $id);
                    return back()->with('error', 'File verified belum tersedia. Harap lakukan verifikasi terlebih dahulu.');
                }

                $filePath = $calibration->location_data;

                \Log::info('📂 File path dari DB: ' . $filePath);

                // Pastikan path sesuai dengan folder public/data_verified
                $expectedFolder = rtrim(public_path('data_verified'), '/\\') . DIRECTORY_SEPARATOR;
                $normalizedPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $filePath);

                // Security check: pastikan file memang di dalam folder data_verified
                if (strpos($normalizedPath, $expectedFolder) !== 0) {
                    \Log::error('Security violation: File path tidak di dalam folder data_verified');
                    return back()->with('error', 'Akses file tidak diizinkan.');
                }

                // Cek apakah file benar-benar ada
                if (!file_exists($filePath)) {
                    \Log::error('File tidak ditemukan di server: ' . $filePath);
                    return back()->with('error', 'File verified tidak ditemukan di server. Mungkin telah dipindahkan atau dihapus.');
                }

                $fileSize = filesize($filePath);
                $fileName = basename($filePath);

                \Log::info("✅ File ditemukan! Size: {$fileSize} bytes | Name: {$fileName}");

                // Download file
                return response()->download($filePath, $fileName, [
                    'Content-Type' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                ]);

            } catch (\Exception $e) {
                \Log::error('💥 ERROR download verified: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());

                return back()->with('error', 'Terjadi kesalahan saat mengunduh file: ' . $e->getMessage());
            }
        }


       public function downloadRejected($id)
        {
            try {
                \Log::info('🟢 ===== START DOWNLOAD FILE REJECTED =====');

                // 1. Ambil data calibration
                $calibration = Calibration::findOrFail($id);

                // Validasi status harus 'rejected'
                if ($calibration->status !== 'rejected') {
                    \Log::warning("Attempt to download rejected file but status is: " . $calibration->status);
                    return back()->with('error', 'File hanya bisa di-download saat status Ditolak.');
                }

                // Validasi location_data tidak boleh kosong
                if (empty($calibration->location_data)) {
                    \Log::error("location_data kosong untuk ID: " . $id);
                    return back()->with('error', 'File rejected belum tersedia. Harap lakukan reject terlebih dahulu.');
                }

                $filePath = $calibration->location_data;

                \Log::info('📂 File path dari DB: ' . $filePath);

                // Pastikan path sesuai dengan folder public/data_rejected
                $expectedFolder = rtrim(public_path('data_rejected'), '/\\') . DIRECTORY_SEPARATOR;
                $normalizedPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $filePath);

                // Security check: pastikan file memang di dalam folder data_rejected
                if (strpos($normalizedPath, $expectedFolder) !== 0) {
                    \Log::error('Security violation: File path tidak di dalam folder data_rejected');
                    return back()->with('error', 'Akses file tidak diizinkan.');
                }

                // Cek apakah file benar-benar ada
                if (!file_exists($filePath)) {
                    \Log::error('File tidak ditemukan di server: ' . $filePath);
                    return back()->with('error', 'File rejected tidak ditemukan di server. Mungkin telah dipindahkan atau dihapus.');
                }

                $fileSize = filesize($filePath);
                $fileName = basename($filePath);

                \Log::info("✅ File ditemukan! Size: {$fileSize} bytes | Name: {$fileName}");

                // Download file
                return response()->download($filePath, $fileName, [
                    'Content-Type' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0',
                ]);

            } catch (\Exception $e) {
                \Log::error('💥 ERROR download rejected: ' . $e->getMessage() . ' | Trace: ' . $e->getTraceAsString());

                return back()->with('error', 'Terjadi kesalahan saat mengunduh file: ' . $e->getMessage());
            }
        }


       
          
        /**
         * Generate nama file
         */
        private function generateFileName($calibration)
        {
            $safeName = preg_replace('/[^\w\s\-]/', '_', $calibration->namaAlat);
            $safeSerial = preg_replace('/[^\w\s\-]/', '_', $calibration->NoSeri ?? '');
            
            $safeName = str_replace(' ', '_', $safeName);
            $safeSerial = str_replace(' ', '_', $safeSerial);
            
            $safeName = preg_replace('/_+/', '_', $safeName);
            $safeSerial = preg_replace('/_+/', '_', $safeSerial);
            
            // PASTIKAN .xlsm
            return "Calibrasi_{$safeName}_{$safeSerial}_" . date('Ymd_His') . '.xlsm';
        }
  
       
}