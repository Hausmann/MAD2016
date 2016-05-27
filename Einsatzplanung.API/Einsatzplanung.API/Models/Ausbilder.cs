using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    [Table("ausbilder")]
    public class Ausbilder
    {
        [Key]
        [Column ("AusbilderID")]
        public int AusbilderID { get; set;}

        [Column ("vorname")]
        public string Vorname { get; set;}

        [Column ("nachname")]
        public string Nachname { get; set;}

        [Column ("abteilungID")]
        public int AbteilungID { get; set;}

        [Column ("persNr")]
        public int PersNr { get; set;}
    }
}