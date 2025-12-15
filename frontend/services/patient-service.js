let PatientService = {
  init: function () {
    $("#addPatientForm").validate({
      submitHandler: function (form) {
        const patient = Object.fromEntries(new FormData(form).entries());
        PatientService.addPatient(patient);
        form.reset();
      },
    });

    $("#editPatientForm").validate({
      submitHandler: function (form) {
        const patient = Object.fromEntries(new FormData(form).entries());
        PatientService.editPatient(patient);
      },
    });

    PatientService.getAllPatients();
  },

  openAddModal: function () {
    $("#addPatientModal").show();
  },

  closeModal: function () {
    $("#editPatientModal").hide();
    $("#deletePatientModal").modal("hide");
    $("#addPatientModal").hide();
  },

  addPatient: function (patient) {
    $.blockUI({ message: "<h3>Processing...</h3>" });

    // BACKEND: POST /patients
    RestClient.post(
      "patients",
      patient,
      function (response) {
        toastr.success("Patient added successfully");
        $.unblockUI();
        PatientService.getAllPatients();
        PatientService.closeModal();
      },
      function (response) {
        $.unblockUI();
        PatientService.closeModal();
        toastr.error(response?.message || "Failed to add patient");
      }
    );
  },

  getAllPatients: function () {
    // BACKEND: GET /patients
    RestClient.get(
      "patients",
      function (data) {
        Utils.datatable(
          "patients-table",
          [
            // Adjust these columns to match your DB fields
            { data: "name", title: "Name" },      // or first_name/last_name
            { data: "email", title: "Email" },
            { data: "phone", title: "Phone" },
            {
              title: "Actions",
              render: function (data, type, row, meta) {
                const rowStr = encodeURIComponent(JSON.stringify(row));
                return `
                  <div class="d-flex justify-content-center gap-2 mt-3">
                    <button class="btn btn-primary" onclick="PatientService.openEditModal('${row.id}')">Edit Patient</button>
                    <button class="btn btn-danger" onclick="PatientService.openConfirmationDialog(decodeURIComponent('${rowStr}'))">Delete Patient</button>
                    <button class="btn btn-secondary" onclick="PatientService.openViewMore('${row.id}')">View More</button>
                  </div>
                `;
              },
            },
          ],
          data,
          10
        );
      },
      function (xhr, status, error) {
        console.error("Error fetching patients:", error);
      }
    );
  },

  getPatientById: function (id) {
    $.blockUI({ message: "<h3>Processing...</h3>" });

    // BACKEND: GET /patients/{id}
    RestClient.get(
      "patients/" + id,
      function (data) {
        localStorage.setItem("selected_patient", JSON.stringify(data));

        
        $('input[name="name"]').val(data.name);
        $('input[name="email"]').val(data.email);
        $('input[name="phone"]').val(data.phone);
        $('input[name="id"]').val(data.id);

        $.unblockUI();
      },
      function () {
        console.error("Error fetching patient by id");
        $.unblockUI();
      }
    );
  },

  openViewMore: function (id) {
    window.location.replace("#view_more");
    PatientService.getPatientById(id);
  },

  populateViewMore: function () {
    const selected_patient = JSON.parse(localStorage.getItem("selected_patient"));

    //
    $("#patient-name").text(selected_patient?.name || "");
    $("#patient-email").text(selected_patient?.email || "");
    $("#patient-phone").text(selected_patient?.phone || "");
  },

  openEditModal: function (id) {
    $("#editPatientModal").show();
    PatientService.getPatientById(id);
  },

  editPatient: function (patient) {
    $.blockUI({ message: "<h3>Processing...</h3>" });

    
    RestClient.put(
      "patients/" + patient.id,
      patient,
      function () {
        $.unblockUI();
        toastr.success("Patient edited successfully");
        PatientService.closeModal();
        PatientService.getAllPatients();
      },
      function (xhr) {
        console.error("Error editing patient");
        $.unblockUI();
        toastr.error(xhr?.responseJSON?.message || "Failed to edit patient");
      }
    );

    
  },

  openConfirmationDialog: function (patient) {
    patient = JSON.parse(patient);

    $("#deletePatientModal").modal("show");
    $("#delete-patient-body").html("Do you want to delete patient: " + (patient.name || patient.email));
    $("#delete_patient_id").val(patient.id);
  },

  deletePatient: function () {
    const id = $("#delete_patient_id").val();

    // BACKEND: DELETE /patients/{id}
    RestClient.delete(
      "patients/" + id,
      null,
      function (response) {
        PatientService.closeModal();
        toastr.success(response?.message || "Patient deleted");
        PatientService.getAllPatients();
      },
      function (response) {
        PatientService.closeModal();
        toastr.error(response?.message || "Failed to delete patient");
      }
    );
  },
};
