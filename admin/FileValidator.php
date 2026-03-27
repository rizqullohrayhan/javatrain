<?php
/**
 * Class untuk validasi dan proses file upload dengan aman
 */
class FileValidator {
    
    private $allowed_types = [];
    private $max_size = 5242880; // 5MB default
    private $upload_dir = '../uploads/';
    
    public function __construct($allowed_types = [], $max_size = 5242880) {
        $this->allowed_types = $allowed_types ?: ['image/jpeg', 'image/png', 'application/pdf'];
        $this->max_size = $max_size;
        
        // Buat folder uploads jika belum ada
        if (!is_dir($this->upload_dir)) {
            mkdir($this->upload_dir, 0755, true);
        }
    }
    
    /**
     * Validasi dan simpan file upload
     */
    public function validateAndSave($file_input_name) {
        if (!isset($_FILES[$file_input_name])) {
            return ['success' => false, 'message' => 'File tidak ditemukan'];
        }
        
        $file = $_FILES[$file_input_name];
        
        // ✅ Cek error upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'Error upload: ' . $this->getUploadErrorMessage($file['error'])];
        }
        
        // ✅ Cek ukuran file
        if ($file['size'] > $this->max_size) {
            return ['success' => false, 'message' => 'Ukuran file terlalu besar (maksimal ' . ($this->max_size / 1024 / 1024) . 'MB)'];
        }
        
        // ✅ Cek MIME type menggunakan finfo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mime_type, $this->allowed_types)) {
            return ['success' => false, 'message' => 'Tipe file tidak diizinkan. MIME type: ' . $mime_type];
        }
        
        // ✅ Generate nama file unik
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid('file_', true) . '_' . bin2hex(random_bytes(8)) . '.' . $file_extension;
        $upload_path = $this->upload_dir . $new_filename;
        
        // ✅ Pindahkan file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            return [
                'success' => true,
                'message' => 'File berhasil diupload',
                'filename' => $new_filename,
                'path' => $upload_path,
                'mime_type' => $mime_type,
                'size' => $file['size']
            ];
        } else {
            return ['success' => false, 'message' => 'Gagal memindahkan file'];
        }
    }
    
    /**
     * Hapus file yang sudah diupload
     */
    public function deleteFile($filename) {
        $filepath = $this->upload_dir . $filename;
        
        if (file_exists($filepath) && is_file($filepath)) {
            if (unlink($filepath)) {
                return ['success' => true, 'message' => 'File berhasil dihapus'];
            }
        }
        
        return ['success' => false, 'message' => 'Gagal menghapus file'];
    }
    
    /**
     * Dapatkan pesan error upload
     */
    private function getUploadErrorMessage($error_code) {
        $errors = [
            UPLOAD_ERR_OK => 'Tidak ada error',
            UPLOAD_ERR_INI_SIZE => 'File terlalu besar (melampaui upload_max_filesize)',
            UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (melampaui MAX_FILE_SIZE)',
            UPLOAD_ERR_PARTIAL => 'File hanya terupload sebagian',
            UPLOAD_ERR_NO_FILE => 'File tidak diupload',
            UPLOAD_ERR_NO_TMP_DIR => 'Folder tmp tidak ditemukan',
            UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file',
            UPLOAD_ERR_EXTENSION => 'Upload dihentikan oleh extension PHP'
        ];
        
        return $errors[$error_code] ?? 'Error tidak diketahui';
    }
}
?>