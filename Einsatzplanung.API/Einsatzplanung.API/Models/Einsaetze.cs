using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    [Table("einsaetze")]
    public class Einsaetze
    {
        [Key]
        [Column("einsatzID")]
        public int EinsatzID { get; set; }

        [Column("abteilungID")]
        public int AbteilungID { get; set; }

        [Column("azubiID")]
        public int AzubiID { get; set; }

        [Column("vonDatum")]
        public string VonDatum { get; set; }

        [Column("bisDatum")]
        public string BisDatum { get; set; }

        [Column("status")]
        public string Status { get; set; }
    }
}