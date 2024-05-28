


 public function instituteAttachments($registry_type_id, $registration_structure_id = null, $application_category_id = null)
    {
        // Construct the base query
        $query = Attachment_type::where('status_id', 1)
            ->where('is_backend', 0);
    
        // Include attachments where registry_type_id matches the provided value or is 0
        $query->where(function ($query) use ($registry_type_id) {
            $query->where('registry_type_id', $registry_type_id)
                  ->orWhere('registry_type_id', 0);
        });
    
        // Include attachments where registration_structure_id matches the provided value or is 0
        if ($registration_structure_id !== null) {
            $query->where(function ($query) use ($registration_structure_id) {
                $query->where('registration_structure_id', $registration_structure_id)
                      ->orWhere('registration_structure_id', 0);
            });
        }
    
        // Include attachments where application_category_id matches the provided value or is 0
        if ($application_category_id !== null) {
            $query->where(function ($query) use ($application_category_id) {
                $query->where('application_category_id', $application_category_id)
                      ->orWhere('application_category_id', 0);
            });
        }
    
        // Execute the query
        $attachments = $query->get();
        $response = ['attachment_types' => $attachments];
        return response()->json($response, 200);
    
    }