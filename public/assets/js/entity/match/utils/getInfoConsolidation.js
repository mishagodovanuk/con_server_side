export function getInfoConsolidation() {
    const pathname = window.location.pathname.match(/\/([^\/]+)$/)[1];
    switch (pathname) {
        case "joint-ftl":
            return { name: "Joint FTL", type: "common_ftl" };
        case "larger-transport":
            return { name: "Larger transport", type: "lg_transport" };
        case "draft":
            return { name: "drafts", type: "drafts" };
        case "rejected":
            return { name: "rejected", type: "rejected" };
        default:
            return { name: "Top Up", type: "uploading" };
    }
}
