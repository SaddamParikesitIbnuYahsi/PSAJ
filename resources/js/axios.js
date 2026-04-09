import axios from "axios";

const web = axios.create({
  // UBAH DISINI: Gunakan "/" agar otomatis mendeteksi localhost atau domain asli
  baseURL: "/",  
  
  withCredentials: true, // WAJIB: Agar cookie login tersimpan
  headers: {
    "X-Requested-With": "XMLHttpRequest",
    "Accept": "application/json",
  },
});

export default web;