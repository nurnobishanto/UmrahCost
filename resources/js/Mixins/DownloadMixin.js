export default {
    methods: {
        downloadCSV(url, label) {
            this.downloadItem(url, label, "text/csv");
        },
        downloadExcel(url, label) {
            this.downloadItem(
                url,
                label,
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            );
        },
        downloadItem(url, label, fileType) {
            axios.get(url, { responseType: "blob" }).then((res) => {
                const blob = new Blob([res.data], {
                    type: fileType,
                });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = label;
                link.click();
                URL.revokeObjectURL(link.href);
            });
        },
    },
};
