export function baseUrl(path = "") {
    return `${window.location.origin}/${path}`.replace(/([^:]\/)\/+/g, "$1");
}
