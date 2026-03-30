import axios from "axios";

const web = axios.create({
  baseURL: "https://imadinahharomain.com",  // root aplikasi Laravel
  withCredentials: true,              // kirim cookie & XSRF-TOKEN
  headers: {
    Accept: "application/json",
  },
});

export default web;

