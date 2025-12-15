// frontend/utils/utils.js

let Utils = {
  datatable: function (table_id, columns, data, pageLength = 15) {
    if ($.fn.dataTable.isDataTable("#" + table_id)) {
      $("#" + table_id).DataTable().destroy();
    }
    $("#" + table_id).DataTable({
      data: data,
      columns: columns,
      pageLength: pageLength,
      lengthMenu: [2, 5, 10, 15, 25, 50, 100, "All"],
    });
  },

  // JWT payload extractor (base64url-safe)
  parseJwt: function (token) {
    if (!token) return null;
    try {
      const payload = token.split(".")[1];
      const base64 = payload.replace(/-/g, "+").replace(/_/g, "/");
      const jsonPayload = decodeURIComponent(
        atob(base64)
          .split("")
          .map((c) => "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2))
          .join("")
      );
      return JSON.parse(jsonPayload);
    } catch (e) {
      console.error("Invalid JWT token", e);
      return null;
    }
  },

  // Load patients and render to a DataTable
  loadPatientsToTable: function (table_id, columns, pageLength = 15) {
    PatientService.getAllPatients()
      .then((Patients) => {
        Utils.datatable(table_id, columns, patients, pageLength);
      })
      .catch((err) => {
        console.error(err);
        toastr.error("Failed to load patients.");
      });
  },
};
